import {Injectable} from "@angular/core";
import { Storage } from '@ionic/storage';

@Injectable()
export class HotelService {
  cnics: any;
  cnicsTemp: any;
  campaigns: any;
  campaignsTemp: any;
  professions: any;
  professionsTemp: any;
  account: any = "";

  name: string;
  email: string;
  userIdTag: string;
  password: string;
  username: string;

  myLng: number;
  myLat: number;

  base64img:string='';
  url:'https://projects.anomoz.com/fooPan/imageUpload.php';

  constructor(public storage: Storage) {
    this.checkifAccount();
    this.cnics = []
    /**
    this.cnics = [{
      'name': 'ahsan ahmed',
      'phone': '03362736273',
      'address': 'home',
      'profession': '1',
      'nFamily': '3',
      'reference': 'none',
      'cnic': 123,
      'eligibleforZakat': 'no',
      'income': 52000
    }]
     */

    this.getCNICsFromServer();
    this.getCampaignsFromServer();  
    this.getProfessionsFromServer();    

  }

  checkifAccount(){
    
    this.storage.get('userBasicInfo').then((val) => {
        console.log("account value found", val)
      if (val===null){
        //console.log("no account found. Error!!!", val);
        this.account = null;
        //this.setRoot('page-register');
      }
      else{
        this.account = val;
        this.username = val.name;
        this.userIdTag = val.userIdTag
        //console.log("account found", val);    
      }
    });
     
    1;
  }


  getCNICsFromServer(){
    var InitiateGetTransactions = function(callback) // How can I use this callback?
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
                 //console.log("no response for resturants") // Another callback here
             }
         }; 
         //console.log("sending _this.userIdTag to server", userIdTag)
         request.open("POST", "https://api.anomoz.com/api/ngo-relief/post/read_all_cnics.php");
         request.send();
     }
     
     var _this = this;
     var frameTransactions = function mycallback(data) {
      _this.cnicsTemp = []
       console.log("cnics received from server," , data)
       var dataParsed;
       dataParsed = JSON.parse(data);
       if(dataParsed.message=="none"){
         //console.log("no bookings")
       }
       else{
         var sampleTrans = dataParsed
           //console.log(sampleTrans)
           for (var i=0; i<sampleTrans.length; i++){
            //check if hotel already
              var a = {
                cnic: sampleTrans[i].cnic,
                BeneficiaryID: sampleTrans[i].BeneficiaryID,
                Name: sampleTrans[i].Name,
                Address: sampleTrans[i].Address,
                Phone: sampleTrans[i].Phone,
                Reference: sampleTrans[i].Reference,
                eligibleforZakat: sampleTrans[i].eligibleforZakat,
                Income: sampleTrans[i].Income,
                Occupation: sampleTrans[i].Occupation,
            }
            _this.cnicsTemp.push(a)
          	
          }
          //add to local storage
          _this.cnics = _this.cnicsTemp
          console.log("cnics updated", _this.cnics)
          //_this.storage.set('resturants', _this.hotels);
       }
     }
     InitiateGetTransactions(frameTransactions); //passing mycallback as a method 
  }

  getCampaignsFromServer(){
    var InitiateGetTransactions = function(callback) // How can I use this callback?
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
                 //console.log("no response for resturants") // Another callback here
             }
         }; 
         //console.log("sending _this.userIdTag to server", userIdTag)
         request.open("POST", "https://api.anomoz.com/api/ngo-relief/post/read_all_campaigns.php?orgId=4");
         request.send();
     }
     
     var _this = this;
     var frameTransactions = function mycallback(data) {
      _this.campaignsTemp = []
       console.log("campaigns received from server," , data)
       var dataParsed;
       dataParsed = JSON.parse(data);
       if(dataParsed.message=="none"){
         //console.log("no bookings")
       }
       else{
         var sampleTrans = dataParsed
           //console.log(sampleTrans)
           for (var i=0; i<sampleTrans.length; i++){
            //check if hotel already
              var a = {
                CampaignID: sampleTrans[i].CampaignID,
                title: sampleTrans[i].title,
            }
            _this.campaignsTemp.push(a)
          	
          }
          //add to local storage
          _this.campaigns = _this.campaignsTemp
          console.log("campaigns updated", _this.campaigns)
          //_this.storage.set('resturants', _this.hotels);
       }
     }
     InitiateGetTransactions(frameTransactions); //passing mycallback as a method 
  }

  getProfessionsFromServer(){
    var InitiateGetTransactions = function(callback) // How can I use this callback?
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
                 //console.log("no response for resturants") // Another callback here
             }
         }; 
         //console.log("sending _this.userIdTag to server", userIdTag)
         request.open("POST", "https://api.anomoz.com/api/ngo-relief/post/read_all_professions.php");
         request.send();
     }
     
     var _this = this;
     var frameTransactions = function mycallback(data) {
      _this.professionsTemp = []
       console.log("professions received from server," , data)
       var dataParsed;
       dataParsed = JSON.parse(data);
       if(dataParsed.message=="none"){
         //console.log("no bookings")
       }
       else{
         var sampleTrans = dataParsed
           //console.log(sampleTrans)
           for (var i=0; i<sampleTrans.length; i++){
            //check if hotel already
              var a = {
                id: sampleTrans[i].id,
                title: sampleTrans[i].title,
            }
            _this.professionsTemp.push(a)
          	
          }
          //add to local storage
          _this.professions = _this.professionsTemp
          console.log("professions updated", _this.professions)
          //_this.storage.set('resturants', _this.hotels);
       }
     }
     InitiateGetTransactions(frameTransactions); //passing mycallback as a method 
  }


  storeSignupData(name, email, password, userIdTag){
    this.name = name;
    this.email = email;
    this.password = password;
    this.userIdTag = userIdTag;

    var tempInfo = {
      "name": this.name,
      "email": this.email,
      "password": this.password,
      "userIdTag": this.userIdTag    
    }
    // set a key/value
    //console.log("storage updated to (signup):", tempInfo);
    this.account = tempInfo
    console.log("storing data", tempInfo)
    this.storage.set('userBasicInfo', tempInfo);
  }

  setUserLocation(lat, lng){
    this.myLat = lat;
    this.myLng = lng;
  }

  getUserLocation_lat(){
    return this.myLat
  }

  getUserLocation_lng(){
    return this.myLng
  }

  setImage(img){
    this.base64img=img;
  }
  getImage(){
    return this.base64img;
  }
  
}
