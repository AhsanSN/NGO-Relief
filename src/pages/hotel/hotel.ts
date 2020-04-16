import {Component} from "@angular/core";
import {IonicPage, NavController, NavParams, ToastController, Platform, ActionSheetController} from "ionic-angular";
import {HotelService} from "../../providers/hotel-service";
//import { File } from '@ionic-native/file/ngx';
import { Geolocation } from "@ionic-native/geolocation";
import { App } from 'ionic-angular';
import { Storage } from '@ionic/storage';


@IonicPage({
  name: 'page-hotel',
  segment: 'hotel',
  priority: 'high'
})

@Component({
  selector: 'page-hotel',
  templateUrl: 'hotel.html'
})
export class HotelPage {
  // list of hotels
  public hotels: any;
  nPeople: string;
  resturantNameSearch: string;
  hotelsCopy: any;
  
  // Map
  lat: number = -22.9068;
  lng: number = -43.1729;

  constructor(public storage: Storage, public app: App, public nav: NavController, public navParams: NavParams, public hotelService: HotelService, public platform: Platform, public actionSheetController: ActionSheetController, public geo: Geolocation, public toastCtrl: ToastController) {
   
  }

  ionViewDidLoad() {
  //window.open("https://anomoz.com", '_system');
     // set sample data
     this.hotels = []
     this.hotels = this.hotelService.getAll();
     console.log(this.hotels)
     this.nPeople = "2";
     this.resturantNameSearch = ""
     //Maintain a copy of data on which needs a search
     this.hotelsCopy = this.hotels;
 
     this.getUserLocation();
    
    // init map
    // this.initializeMap();
    var _this2 = this; 
    setTimeout(function(){
      _this2.updateData1_4()
    }, 100);

    setTimeout(function(){
      _this2.updateData1_4()
    }, 200);  

    setTimeout(function(){
      _this2.updateData1_4()
    }, 300);

    setTimeout(function(){
      _this2.updateData1_4()
    }, 500);

    setTimeout(function(){
          _this2.updateData1_4()
    }, 900);

    setTimeout(function(){
      _this2.updateData1_4()
    }, 1100);

    setTimeout(function(){
      _this2.updateData1_4()
    }, 1300);

    setTimeout(function(){
      _this2.updateData1_4()
    }, 1500);

    
    this.storage.get('userBasicInfo').then((val) => {
      console.log("account value found", val)
    if (val===null){
      //console.log("no account found. Error!!!", val);
      this.nav.setRoot('page-register');
    }      
    });

  }

  updateData1_4(){
    //console.log("hotels data", this.hotels);
    
    if (true){
      this.hotels = this.hotelService.getAll();
      this.hotelsCopy = this.hotels
    }
    //console.log("hotels", this.hotels)
    //console.log("this.hotelService.getAcountStatus()", this.hotelService.getAcountStatus())
    
  }
  

  nPeopleChanged(){
    this.hotelService.setNPeople(this.nPeople)
  }

  // view hotel detail
  viewHotel(hotel) {
    // console.log(hotel.id)
    this.hotelService.setResturantId(hotel.id);
    this.nav.push('page-trips', {
      'id': hotel.id
    });
  }

  // initializeMap() {
  //   let latLng = new google.maps.LatLng(this.hotels[0].location.lat, this.hotels[0].location.lon);

  //   let mapOptions = {
  //     center: latLng,
  //     zoom: 11,
  //     scrollwheel: false,
  //     mapTypeId: google.maps.MapTypeId.ROADMAP,
  //     mapTypeControl: false,
  //     zoomControl: false,
  //     streetViewControl: false
  //   }

  //   this.map = new google.maps.Map(document.getElementById("map"), mapOptions);

  //   // add markers to map by hotel
  //   for (let i = 0; i < this.hotels.length; i++) {
  //     let hotel = this.hotels[i];
  //     new google.maps.Marker({
  //       map: this.map,
  //       animation: google.maps.Animation.DROP,
  //       position: new google.maps.LatLng(hotel.location.lat, hotel.location.lon)
  //     });
  //   }

  //   // refresh map
  //   setTimeout(() => {
  //     google.maps.event.trigger(this.map, 'resize');
  //   }, 300);
  // }

  // view all hotels
  viewHotels() {
    this.nav.push('page-hotel');
  }

  changeNPeople(){
    console.log("changeNPeople called")
    this.presentActionSheetForNPeople()
  }

  async presentActionSheetForNPeople() {
    const actionSheet = await this.actionSheetController.create({
      buttons: [{
        text: '2',
        role: 'destructive',
        icon: 'people',
        handler: () => {
          this.changeNPeopleMain("2");
        }
      }, {
        text: '3',
        role: 'destructive',
        icon: 'people',
        handler: () => {
          this.changeNPeopleMain("3");
        }
      },
      {
        text: '5+',
        role: 'destructive',
        icon: 'people',
        handler: () => {
          this.changeNPeopleMain("5+");
        }
      },
      {
        text: '8+',
        role: 'destructive',
        icon: 'people',
        handler: () => {
          this.changeNPeopleMain("8+");
        }
      },
      {
        text: '10+',
        role: 'destructive',
        icon: 'people',
        handler: () => {
          this.changeNPeopleMain("10+");
        }
      },
       {
        text: 'Cancel',
        icon: 'close',
        role: 'cancel',
        handler: () => {
          console.log('Cancel clicked');
        }
      }]
    });
    await actionSheet.present();
  }

  changeNPeopleMain(nPeople){
    console.log("changeNPeopleMain called")
    this.nPeople = nPeople
    this.hotelService.setNPeople(nPeople);
  }

  resetChanges(){
    console.log("reset", this.hotels, this.hotelsCopy)
    this.hotels = this.hotelsCopy
  }
  
  searchResturants(){
    //console.log("keywords", this.resturantNameSearch)
    this.resetChanges();
    this.hotels = this.hotels.filter((item)=>{
      return item.name.toLowerCase().indexOf(this.resturantNameSearch.toLowerCase())>-1;
    })
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

    refresh(){
      this.hotelService.getResturantsFromServer();
      this.hotels = this.hotelService.getAll();
      var _this2 = this; 
    setTimeout(function(){
      _this2.updateData1_4()
    }, 100);

    setTimeout(function(){
      _this2.updateData1_4()
    }, 200);  

    setTimeout(function(){
      _this2.updateData1_4()
    }, 300);

    setTimeout(function(){
      _this2.updateData1_4()
    }, 500);

    setTimeout(function(){
          _this2.updateData1_4()
    }, 900);

    setTimeout(function(){
      _this2.updateData1_4()
    }, 1100);

    setTimeout(function(){
      _this2.updateData1_4()
    }, 1300);

    setTimeout(function(){
      _this2.updateData1_4()
    }, 1500);

    // show message
    let toast = this.toastCtrl.create({
      showCloseButton: true,
      cssClass: 'refresh-bgg',
      message: 'Menu Refreshed...',
      duration: 3000,
      position: 'bottom'
    });

    toast.present();


    }

}
