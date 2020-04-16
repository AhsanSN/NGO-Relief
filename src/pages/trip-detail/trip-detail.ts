import {Component} from "@angular/core";
import {IonicPage, NavParams, NavController, LoadingController, ToastController} from "ionic-angular";
import {HotelService} from "../../providers/hotel-service";

@IonicPage({
  name: 'page-trip-detail',
  segment: 'trip-detail/:id'
})

@Component({
  selector: 'page-trip-detail',
  templateUrl: 'trip-detail.html'
})
export class TripDetailPage {
  paramItemId: number;
  paramResturantId: number;
  form = [];
  addons:any;
  nItemsinCart:number;
  // trip info
  public trip: any;
  // number of adult
  public quantity = 1;
  
  // number of children

  constructor(public nav: NavController, public navParams: NavParams, public hotelService: HotelService, public loadingCtrl: LoadingController, public toastCtrl: ToastController) {
    // set sample data
    this.paramResturantId = this.navParams.get('resturantId');
    this.paramItemId = this.navParams.get('itemId');
    this.trip = this.hotelService.getItemFromMenu(this.paramItemId, this.paramResturantId);
    this.addons = this.trip.addons
    
    //this.trip = this.hotelService.getItemFromMenu(1,1);

  }

  // minus adult when click minus button
  minusAdult() {
    this.quantity--;
  }

  // plus adult when click plus button
  plusAdult() {
    this.quantity++;
  }

  // go to checkout page
  checkout(trip) {
    this.nav.push('page-checkout-trip', {
      'id': trip.id
    });
  }

  addItemToCart(){
    
    if(this.quantity>0){
      
      var tempAddons = [];
      this.addons.forEach((val, i) => {
        if (val.isChecked === true) {
          tempAddons.push(val)
        }
      });
      console.log("selected addons", tempAddons)
      
      tempAddons.forEach((val, i) => {
        this.hotelService.addItemToCart(val.id,this.quantity, true, this.paramItemId);
      });
    }
    
    // process send button
    this.hotelService.addItemToCart(this.paramItemId,this.quantity, false, this.paramItemId);
 
    // show message
    let toast = this.toastCtrl.create({
      showCloseButton: true,
      cssClass: 'profile-bg',
      message: 'Item Added!',
      duration: 300,
      position: 'bottom'
    });

    setTimeout(() => {
      toast.present();
      // back to home page
      //this.nav.setRoot('page-home');
      this.nav.pop();
    }, 10)
    
  }

  ionViewWillEnter(){
    this.nItemsinCart = this.hotelService.getCartLength();
    console.log("ionViewWillEnter called", this.nItemsinCart)

  }

  viewOrder(){
    this.nav.push('page-checkout-hotel')
  }
}

