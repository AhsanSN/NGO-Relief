import {Component, OnInit} from "@angular/core";
import {IonicPage, NavController, NavParams, ToastController, Platform, ActionSheetController} from "ionic-angular";
import {HotelService} from "../../providers/hotel-service";
//import { File } from '@ionic-native/file/ngx';
import { Geolocation } from "@ionic-native/geolocation";
import { App } from 'ionic-angular';
import { Storage } from '@ionic/storage';
import { FormBuilder, FormGroup, Validators } from "@angular/forms";


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

  public onLoginForm: FormGroup;
  
  // Map
  lat: number = -22.9068;
  lng: number = -43.1729;
  cnics: any;
  ngoName: string = "";
  collectionCenter = ""
  reference = ""

  constructor(public storage: Storage, public app: App, private _fb: FormBuilder, public nav: NavController, public navParams: NavParams, public hotelService: HotelService, public platform: Platform, public actionSheetController: ActionSheetController, public geo: Geolocation, public toastCtrl: ToastController, ) {
    this.storage.get('ngo_relief_data_collected').then((val) => {
      if (val===null){
        console.log("no data found. Error!!!", val);
      }
      else{
        console.log("val", val)
        this.collectionCenter = val.collectionCenter;
        this.reference = val.reference;
        this.onLoginForm.setValue({
         "name": "",
         "cnic": "",
         "phone": "",
         "address": "",
         "profession": "",
         "nFamily": "",
         "collectionCenter":this.collectionCenter,
         "reference":this.reference,
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
      nFamily: ["", Validators.compose([
        Validators.required
      ])],
      reference: [this.reference, Validators.compose([
        Validators.required
      ])],
      collectionCenter: [this.collectionCenter, Validators.compose([
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
     this.getUserLocation();
        
    this.storage.get('userBasicInfo').then((val) => {
      console.log("account value found", val)
      this.ngoName = val.name;
    if (val===null){
      //console.log("no account found. Error!!!", val);
      this.nav.setRoot('page-register');
    }      
    });

    var _this22 = this;
    setTimeout(function(){
      _this22.cnics = [];
      _this22.hotelService.cnics.forEach(element => {
        _this22.cnics.push(element.cnic);
      });
    }, 4000);

    setTimeout(function(){
      _this22.cnics = [];
      _this22.hotelService.cnics.forEach(element => {
        _this22.cnics.push(element.cnic);
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


    sendEntry(name, cnic, phone, address, profession, nFamily, reference, collectionCenter){

      this.geo.getCurrentPosition().then((resp) => {
        console.log("location:", resp.coords.latitude, resp.coords.longitude)
        var details = {
          "user_id": this.hotelService.userIdTag,
          "name": name,
          "phone": phone,
          "cnic": cnic,
          "address": address,
          "profession": profession,
          "nFamily": nFamily,
          "reference": reference,
          "collectionCenter": collectionCenter,
          "lat": resp.coords.latitude,
          "lng": resp.coords.longitude
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
        }
        InitiateUploadUser(frameUploadUser); //passing mycallback as a method  
  }

    about(){
      this.nav.push("page-about")
    }


   

}
