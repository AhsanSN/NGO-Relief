import { NgModule } from '@angular/core';
import { IonicPageModule } from 'ionic-angular';
import { AgmCoreModule } from '@agm/core';
import { HotelPage } from './hotel';
import { IonicImageLoader } from 'ionic-image-loader';

@NgModule({
  declarations: [
    HotelPage
  ],
  imports: [
    IonicPageModule.forChild(HotelPage),
    AgmCoreModule.forRoot({
      apiKey: 'AIzaSyCZi5b4jUyWZ-QMOt6azHzC4uSaD3VUSwM'
    }),
    IonicImageLoader
  ],
  exports: [
    HotelPage
  ]
})

export class HotelPageModule { }
