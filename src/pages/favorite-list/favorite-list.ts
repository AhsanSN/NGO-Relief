import { Component } from '@angular/core';

import { HotelPage } from '../hotel/hotel';
import { AccountPage } from '../account/account';
import { BookingListPage } from '../booking-list/booking-list';


@Component({
  templateUrl: 'favorite-list.html'
})
export class FavoriteListPage {

  tab1Root = HotelPage;
  tab2Root = AccountPage;
  tab3Root = BookingListPage;

  constructor() {

  }
}
