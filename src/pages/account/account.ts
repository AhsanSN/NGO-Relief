import { Component } from "@angular/core";
import { IonicPage, NavController } from "ionic-angular";
import {HotelService} from "../../providers/hotel-service";

@IonicPage({
  name: 'page-account',
  segment: 'account'
})

@Component({
  selector: 'page-account',
  templateUrl: 'account.html'
})
export class AccountPage {

  //dDate: Date = new Date();
  lat: number = -22.9068;
  lng: number = -43.1729;
  public hotels: any;



  constructor(public nav: NavController,  public hotelService: HotelService,) {
  }

  ionViewDidLoad() {
    // set sample data
    this.hotels = this.hotelService.getAll();
    this.lat = -22.9068;
    this.lng = -43.1729;

    // init map
    // this.initializeMap();
    var _this = this; 
    setTimeout(function(){
      _this.updateData1_4()
    }, 100);

    setTimeout(function(){
      _this.updateData1_4()
    }, 200);  

    setTimeout(function(){
      _this.updateData1_4()
    }, 300);

    setTimeout(function(){
      _this.updateData1_4()
    }, 500);

    setTimeout(function(){
          _this.updateData1_4()
    }, 900);

    setTimeout(function(){
      _this.updateData1_4()
    }, 1100);

  }

  updateData1_4(){
    this.hotels = this.hotelService.getAll();
    console.log("hotels data", this.hotels);
    this.lat = this.hotelService.getUserLocation_lat();
    this.lng = this.hotelService.getUserLocation_lng();
    console.log("my fetched pos", this.lat, this.lng)
    
    //convert all hotel pos to numbers
  }

}
