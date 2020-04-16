import { Component, ViewChild } from "@angular/core";
import { Platform, Nav } from "ionic-angular";

import { StatusBar } from '@ionic-native/status-bar';
import { SplashScreen } from '@ionic-native/splash-screen';
import { Keyboard } from '@ionic-native/keyboard';

import { HotelPage } from '../pages/hotel/hotel';
import { ImageLoaderConfig } from 'ionic-image-loader';
import { Storage } from '@ionic/storage';

//import {HotelService} from "../providers/hotel-service";



export interface MenuItem {
    title: string;
    component: any;
    icon: string;
}

@Component({
  templateUrl: 'app.html'
})

export class ionBookingApp {
  @ViewChild(Nav) nav: Nav;

  //rootPage: any = "page-hotel";
  rootPage:any = HotelPage;
  showMenu: boolean = true;
  // rootNavCtrl: NavController;

  //appMenuItems: Array<MenuItem>;
  public name:string;
  constructor(
    public platform: Platform,
    public statusBar: StatusBar,
    public splashScreen: SplashScreen,
    public keyboard: Keyboard,
    public imageLoaderConfig: ImageLoaderConfig,
    public storage: Storage
    //public hotelService: HotelService
  ) {
    this.initializeApp();
    // this.app.getRootNavs()[0]
    // this.app._rootNavs.map(page => {
    //   console.log(page)
    // })
    // console.log(this.nav)

    /**
    this.appMenuItems = [
      {title: 'Home', component: 'page-home', icon: 'home'},
      {title: 'Messages', component: 'page-message-list', icon: 'mail'},
      {title: 'Local Weather', component: 'page-local-weather', icon: 'sunny'},
      {title: 'Rent a Car', component: 'page-search-cars', icon: 'car'},
      {title: 'Trip Activities', component: 'page-search-trips', icon: 'beer'},
      {title: 'Favorites', component: 'page-favorite-list', icon: 'heart'},
      {title: 'Booking List', component: 'page-booking-list', icon: 'briefcase'},
      {title: 'Support', component: 'page-support', icon: 'help-buoy'}
    ];
     */
  }

  initializeApp() {
    this.platform.ready().then(() => {
      // Okay, so the platform is ready and our plugins are available.
      //*** Control Splash Screen
      // this.splashScreen.show();
      // this.splashScreen.hide();

      //*** Control Status Bar
      this.statusBar.styleDefault();
      this.statusBar.overlaysWebView(false);

      this.imageLoaderConfig.enableDebugMode();
      this.imageLoaderConfig.enableFallbackAsPlaceholder(true);
      this.imageLoaderConfig.setFallbackUrl("assets/img/avatar.jpeg")
      this.imageLoaderConfig.setMaximumCacheAge(24*60*60*1000)
      //*** Control Keyboard
      this.keyboard.hide();
      //this.name = this.hotelService.name;
      //console.log("name", this.name)
    });
  }

  openPage(page) {
    // Reset the content nav to have just this page
    // we wouldn't want the back button to show in this scenario
    this.nav.setRoot(page.component);
  }

  logout() {
    this.storage.set('userBasicInfo', null);
    this.nav.setRoot('page-login');
  }

  editProfile() {
    this.nav.setRoot('page-edit-profile');
  }


}
