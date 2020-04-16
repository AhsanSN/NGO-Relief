import {Component} from "@angular/core";
import {IonicPage, NavController, NavParams} from "ionic-angular";
import {HotelService} from "../../providers/hotel-service";

@IonicPage({
  name: 'page-trips',
  segment: 'trips'
})

@Component({
  selector: 'page-trips',
  templateUrl: 'trips.html'
})
export class TripsPage {
  // list of trips
  public trips: any;
  public menuItems: any;
  param: number;
  selectedSegment: any;
  showStarters: boolean;
  showMainCourses: boolean;
  showBeverages: boolean;
  resturantName:string;
  nItemsinCart:number;

  constructor(public nav: NavController, public hotelService: HotelService, public navParams: NavParams,) {
    // set sample data
    this.param = this.navParams.get('id');
    this.selectedSegment="Starters"
    this.trips = hotelService.getMenuOfResturant(this.param);
    this.resturantName = this.hotelService.getResturantName(this.param)
    //this.menuItems = trips
    var _this = this; 
    setTimeout(function(){
      _this.updateData1_4()
    }, 100);

    setTimeout(function(){
      _this.updateData1_4()
    }, 200);  


  }

  updateData1_4(){
    //console.log("trips data", this.trips);
    this.trips = this.hotelService.getMenuOfResturant(this.param);
    this.resturantName = this.hotelService.getResturantName(this.param)
  }

  ionViewWillEnter(){
    this.nItemsinCart = this.hotelService.getCartLength();
    console.log("ionViewWillEnter called", this.nItemsinCart)

  }
  // view trip detail
  viewDetail(id) {
    this.nav.push('page-trip-detail', {
      'resturantId': this.param,
      'itemId': id
    });
  }

  viewOrder(){
    this.nav.push('page-checkout-hotel')
  }

  showCategory(foodCat){
    //console.log("foodCat", foodCat, this.selectedSegment)
    if(foodCat=="Starters" && this.selectedSegment=="Starters"){
      return true;
    }
    if(foodCat=="mainCourses" && this.selectedSegment=="mainCourses"){
      return true;
    }
    if(foodCat=="Beverages" && this.selectedSegment=="Beverages"){
      return true;
    }
    else{
      return false;
    }
  }

}
