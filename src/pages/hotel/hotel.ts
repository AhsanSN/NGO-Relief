import {Component, OnInit, ViewChild, ElementRef} from "@angular/core";
import {IonicPage, NavController, NavParams, ToastController, Platform, ActionSheetController, LoadingController} from "ionic-angular";
import {HotelService} from "../../providers/hotel-service";
//import { File } from '@ionic-native/file/ngx';
import { Geolocation } from "@ionic-native/geolocation";
import { App } from 'ionic-angular';
import { Storage } from '@ionic/storage';
import { FormBuilder, FormGroup, Validators } from "@angular/forms";
import { BaseRequestOptions } from "@angular/http";
import {Camera,CameraOptions} from '@ionic-native/camera';
import { FileTransfer, FileUploadOptions, FileTransferObject } from '@ionic-native/file-transfer';

declare var google;

@IonicPage({
  name: 'page-hotel',
  segment: 'hotel',
  priority: 'high'
})

@Component({
  selector: 'page-hotel',
  templateUrl: 'hotel.html'
})
export class HotelPage implements OnInit{

  @ViewChild('map') mapElement: ElementRef;
  map: any;
  
  public onLoginForm: FormGroup;
  //https://api.anomoz.com/api/ngo-relief/post/read_all_campaigns.php?orgId=4
  
  // Map
  lat: number = -22.9068;
  lng: number = -43.1729;
  cnics: any;
  cnicsDetails: any;
  ngoName: string = "";
  collectionCenter = ""
  reference = ""
  event = ""
  eventId = ""
  CampaignID = ""
  allEvents: any;
  campaigns: any= [];
  professions: any= [];
  base64img:string='';

  constructor(public storage: Storage, public app: App, private _fb: FormBuilder, public nav: NavController, public navParams: NavParams, public hotelService: HotelService, public platform: Platform, public actionSheetController: ActionSheetController, public geo: Geolocation, public toastCtrl: ToastController, private camera:Camera, private transfer: FileTransfer, public loadingCtrl: LoadingController,) {
    this.storage.get('ngo_relief_data_collected').then((val) => {
      if (val===null){
        console.log("no data found. Error!!!", val);
      }
      else{
        console.log("val", val)
        this.collectionCenter = val.collectionCenter;
        this.reference = val.reference;
        this.event = val.event;
        this.eventId = val.eventId;
        this.CampaignID = val.CampaignID;
        this.onLoginForm.setValue({
         "name": "",
         "cnic": "",
         "phone": "",
         "address": "",
         "profession": "",
         "collectionCenter":this.collectionCenter,
         "reference":this.reference,
         "eligibleforZakat": "",
         "income": "",
         "CampaignID":val.CampaignID
        })

      }
    }); 
  }

  ngOnInit() {
    this.onLoginForm = this._fb.group({
      name: ["", Validators.compose([
        Validators.required
      ])],
      cnic: ["", Validators.compose([
        Validators.required
      ])],
      phone: ["", Validators.compose([
        Validators.required
      ])],
      address: ["", Validators.compose([
        Validators.required
      ])],
      profession: ["", Validators.compose([
        Validators.required
      ])],
      reference: [this.reference, Validators.compose([
        Validators.required
      ])],
      collectionCenter: [this.collectionCenter, Validators.compose([
        Validators.required
      ])],
      eligibleforZakat: ["", Validators.compose([
        Validators.required
      ])],
      income: ["", Validators.compose([
        Validators.required
      ])],
      CampaignID: [this.CampaignID, Validators.compose([
        Validators.required
      ])]
    });
  }
  
  searchCnic(){
    if(this.cnics.includes(this.onLoginForm.get('cnic').value)){
      document.getElementById("cnicError").style.display = "block";
    }else{
      document.getElementById("cnicError").style.display = "none";
    }
  }
  
  ionViewDidLoad() {  
    //this.loadMap()  
     this.getUserLocation();
        
    this.storage.get('userBasicInfo').then((val) => {
      console.log("account value found", val)
    if (val===null){
      //console.log("no account found. Error!!!", val);
      this.nav.setRoot('page-login');
    }else{
      this.ngoName = val.name;
    }      
    });

    var _this22 = this;
    setTimeout(function(){
      _this22.campaigns = _this22.hotelService.campaigns
      _this22.professions = _this22.hotelService.professions
    }, 1000);

    setTimeout(function(){
      _this22.campaigns = _this22.hotelService.campaigns
      _this22.professions = _this22.hotelService.professions
    }, 2000);

    setTimeout(function(){
      _this22.cnics = [];
      _this22.hotelService.cnics.forEach(element => {
        _this22.cnics.push(element.cnic);
      });

      _this22.cnicsDetails = [];
      _this22.hotelService.cnics.forEach(element => {
        _this22.cnicsDetails.push(element);
      });

      _this22.campaigns = _this22.hotelService.campaigns
      _this22.professions = _this22.hotelService.professions
    }, 4000);

    setTimeout(function(){
      _this22.cnics = [];
      _this22.hotelService.cnics.forEach(element => {
        _this22.cnics.push(element.cnic);
      });

      _this22.cnicsDetails = [];
      _this22.hotelService.cnics.forEach(element => {
        _this22.cnicsDetails.push(element);
      });
    }, 8000);

  }

  getUserLocation(){
    console.log("getUserLocation called")
    this.geo.getCurrentPosition().then((resp) => {
      console.log(resp);
      this.hotelService.setUserLocation(resp.coords.latitude, resp.coords.longitude)
      // resp.coords.latitude
      // resp.coords.longitude
     }).catch((error) => {
       console.log('Error getting location', error);
     });
    }

    makeid(length) {
      var result           = '';
      var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
      var charactersLength = characters.length;
      for ( var i = 0; i < length; i++ ) {
         result += characters.charAt(Math.floor(Math.random() * charactersLength));
      }
      return result;
   }

    sendEntry(name, cnic, phone, address, profession, reference, eligibleforZakat, income){

      var imageName = ""
      if(this.base64img!=''){
        imageName = this.makeid(10);
        this.nextPage(imageName)
      }
      

      this.geo.getCurrentPosition().then((resp) => {
        console.log("location:", resp.coords.latitude, resp.coords.longitude)
        var details = {
          "user_id": this.hotelService.userIdTag,
          "name": name,
          "phone": phone,
          "cnic": cnic,
          "address": address,
          "profession": profession,
          "nFamily": "",
          "reference": reference,
          "collectionCenter": this.collectionCenter,
          "lat": resp.coords.latitude,
          "lng": resp.coords.longitude,
          "event": this.event, 
          "eventId": this.eventId,
          "eligibleforZakat": eligibleforZakat, 
          "income": income,
          "CampaignID": this.CampaignID,
          "imageName": imageName
        }
        console.log("details", details)
        this.storage.set('ngo_relief_data_collected', details);
        this.uploadPostToDatabase(details);
       }).catch((error) => {
         console.log('Error getting location', error);
       });

    }

    uploadPostToDatabase(aboutUser){
      var _this3 = this;
       var InitiateUploadUser = function(callback) // How can I use this callback?
        {
            var request = new XMLHttpRequest();
            request.onreadystatechange = function()
            {
                if (request.readyState == 4 && request.status == 200)
                {
                    callback(request.responseText); // Another callback here
                }
                if (request.readyState == 4 && request.status == 0)
                {
                    console.log("no respinse for booking") // Another callback here
                }
            }; 
            request.open("POST", "https://api.anomoz.com/api/ngo-relief/post/put_data_entry.php")
            request.send(JSON.stringify(aboutUser));
        }
        //var _this = this;
        var frameUploadUser = function mycallback(data) {

          console.log("response from server when posting," , data)
          let toast = _this3.toastCtrl.create({
            showCloseButton: true,
            cssClass: 'profile-bg',
            message: 'Data Added to Server',
            duration: 1000,
            position: 'bottom'
          });
      
          toast.present();
          _this3.onLoginForm.setValue({
            "name": "",
            "cnic": "",
            "phone": "",
            "address": aboutUser.address,
            "profession": "",
            "collectionCenter":aboutUser.collectionCenter,
            "reference":aboutUser.reference,
            "eligibleforZakat": "",
            "income": "",
            "CampaignID": aboutUser.CampaignID
           })

        }
        InitiateUploadUser(frameUploadUser); //passing mycallback as a method  
  }

    about(){
      this.nav.push("page-about")
    }

    imageCaptured(){
      const options:CameraOptions={
        quality:70,
        destinationType:this.camera.DestinationType.DATA_URL,
        encodingType:this.camera.EncodingType.JPEG,
        mediaType:this.camera.MediaType.PICTURE
      }
      this.camera.getPicture(options).then((ImageData=>{
         this.base64img="data:image/jpeg;base64,"+ImageData;
      }),error=>{
        console.log(error);
      })
    }
  
    imageCapturedGallery(){
      const options:CameraOptions={
        quality:70,
        destinationType:this.camera.DestinationType.DATA_URL,
        sourceType:this.camera.PictureSourceType.PHOTOLIBRARY,
        saveToPhotoAlbum:false
      }
      this.camera.getPicture(options).then((ImageData=>{
         this.base64img="data:image/jpeg;base64,"+ImageData;
      }),error=>{
        console.log(error);
      })
    }

    nextPage(imagename){
      this.hotelService.setImage(this.base64img);
      //this.nav.push('IdentifyphotoPage');
      this.uploadPic(imagename);
    }

    clear(){
      this.base64img='';
    }

    uploadPic(imagename) {
      this.base64img = this.hotelService.getImage();
      let loader = this.loadingCtrl.create({
        content: "Uploading...."
      });
      loader.present();
  
      const fileTransfer: FileTransferObject = this.transfer.create();
  
      let options: FileUploadOptions = {
        fileKey: "photo",
        fileName: imagename+".jpg",
        chunkedMode: false,
        mimeType: "image/jpeg",
        headers: {}
      }
  
      fileTransfer.upload(this.base64img, 'https://projects.anomoz.com/reliefDB/imageUpload.php', options).then(data => {
        //alert(JSON.stringify(data));
        loader.dismiss();
      }, error => {
        alert("error");
        loader.dismiss();
      });

    }


    autofill(){
      console.log("autofill called", this.cnics, this.cnicsDetails)
      this.cnicsDetails.forEach((element, i) => {
        if(this.onLoginForm.get('cnic').value== element.cnic){
          console.log(element, i)
          this.onLoginForm.setValue({
            "name": element.Name,
            "cnic": element.cnic,
            "phone": element.Phone,
            "address": element.Address,
            "profession": element.Occupation,
            "collectionCenter":this.collectionCenter,
            "reference":element.Reference,
            "eligibleforZakat": element.eligibleforZakat,
            "income": element.Income,
            "CampaignID":this.CampaignID
           })
        }
        
      });
    }

    loadMap(){

      this.geo.getCurrentPosition().then((position) => {
  
        let latLng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
  
        let mapOptions = {
          center: latLng,
          zoom: 15,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
  
        this.map = new google.maps.Map(this.mapElement.nativeElement, mapOptions);
  
      }, (err) => {
        console.log(err);
      });
  
    }

    addMarker(){
      let marker = new google.maps.Marker({
        map: this.map,
        draggable: true, 
        animation: google.maps.Animation.DROP,
        position: this.map.getCenter()
      });
    
      let content = "<h4>Information!</h4>";          
    
      this.addInfoWindow(marker, content);

      var this1 = this;
      google.maps.event.addListener(marker, 'dragend', function() 
      {
        console.log("aa")
          this1.geocodePosition(marker.getPosition());
      });
    
    }

    addInfoWindow(marker, content){

      let infoWindow = new google.maps.InfoWindow({
        content: content
      });
  
      google.maps.event.addListener(marker, 'click', () => {
        infoWindow.open(this.map, marker);
      });
  
    }

    

    geocodePosition(pos) 
    {
      var geocoder = new google.maps.Geocoder();
      geocoder.geocode
        ({
            latLng: pos
        }, 
            function(results, status) 
            {
                if (status == google.maps.GeocoderStatus.OK) 
                {
                   console.log("results[0].formatted_address", results[0].formatted_address)
                } 
                else 
                {
                    console.log("err")
                }
            }
        );
}


}
