import { NgModule } from '@angular/core';
import { IonicPageModule } from 'ionic-angular';
import { AgmCoreModule } from '@agm/core';
import { HotelDetailPage } from './hotel-detail';

@NgModule({
  declarations: [
    HotelDetailPage
  ],
  imports: [
    IonicPageModule.forChild(HotelDetailPage),
    AgmCoreModule.forRoot({
      apiKey: 'AIzaSyCZi5b4jUyWZ-QMOt6azHzC4uSaD3VUSwM'
    })
  ],
  exports: [
    HotelDetailPage
  ]
})

export class HotelDetailPageModule { }
