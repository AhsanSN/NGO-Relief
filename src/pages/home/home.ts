import {Component, OnInit} from "@angular/core";
import {IonicPage, NavController, NavParams, ToastController, Platform, ActionSheetController} from "ionic-angular";
import {HotelService} from "../../providers/hotel-service";
//import { File } from '@ionic-native/file/ngx';
import { Geolocation } from "@ionic-native/geolocation";
import { App } from 'ionic-angular';
import { Storage } from '@ionic/storage';
import { FormBuilder, FormGroup, Validators } from "@angular/forms";
import { BaseRequestOptions } from "@angular/http";

@IonicPage({
  name: 'page-home',
  segment: 'home',
  priority: 'high'
})

@Component({
  selector: 'page-home',
  templateUrl: 'home.html'
})

export class HomePage {
  public onLoginForm: FormGroup;
  //https://api.anomoz.com/api/ngo-relief/post/read_all_campaigns.php?orgId=4
  
  // Map
  lat: number = -22.9068;
  lng: number = -43.1729;
  cnics: any;
  ngoName: string = "";
  collectionCenter = ""
  CampaignID = ""
  allEvents: any;
  campaigns: any= [];

  constructor(public storage: Storage, public app: App, private _fb: FormBuilder, public nav: NavController, public navParams: NavParams, public hotelService: HotelService, public platform: Platform, public actionSheetController: ActionSheetController, public geo: Geolocation, public toastCtrl: ToastController, ) {
    this.storage.get('ngo_relief_data_collected').then((val) => {
      if (val===null){
        console.log("no data found. Error!!!", val);
      }
      else{
        console.log("val", val)
        this.collectionCenter = val.collectionCenter
        this.CampaignID = val.CampaignID
        this.onLoginForm.setValue({
         "collectionCenter":val.collectionCenter,
         "CampaignID":val.CampaignID
        })
      }
    }); 
  }

  ngOnInit() {
    this.onLoginForm = this._fb.group({
      
      collectionCenter: [this.collectionCenter, Validators.compose([
        Validators.required
      ])],
      CampaignID: [this.CampaignID, Validators.compose([
        Validators.required
      ])]
    });
  }

  ionViewDidLoad() {    
        
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
    }, 1000);

    setTimeout(function(){
      _this22.campaigns = _this22.hotelService.campaigns
    }, 2000);

    setTimeout(function(){
      _this22.campaigns = _this22.hotelService.campaigns
    }, 4000);
  }



    sendEntry(collectionCenter, CampaignID){

        var details = {
          "user_id": this.hotelService.userIdTag,
          "name": "",
          "phone": "",
          "cnic": "",
          "address": "",
          "profession": "",
          "nFamily": "",
          "reference": "",
          "collectionCenter": collectionCenter,
          "lat": "",
          "lng": "",
          "event": "", 
          "eventId": "",
          "eligibleforZakat": "", 
          "income": "",
          "CampaignID": CampaignID
        }
        console.log("details", details)
        this.storage.set('ngo_relief_data_collected', details);
        this.nav.push("page-hotel")

    }
  
    about(){
      this.nav.push("page-about")
    }



   

}
