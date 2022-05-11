 <!-- ########## START: LEFT PANEL ########## -->
 <div class="sl-logo"><a href="#"><i class="icon ion-android-star-outline"></i>
         MoveOn</a></div>
 <div class="sl-sideleft">
     <div class="sl-sideleft-menu">

         <a href="{{ route('user.dashboard') }}" class="sl-menu-link">
             <div class="sl-menu-item">
                 <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
                 <span class="menu-item-label">Home</span>
             </div><!-- menu-item -->
         </a><!-- sl-menu-link -->

         <a href="{{ route('create-page') }}" class="sl-menu-link">
             <div class="sl-menu-item">
                 <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
                 <span class="menu-item-label">Create a Page</span>
             </div><!-- menu-item -->
         </a><!-- sl-menu-link -->

         <a href="{{ route('attach-post') }}" class="sl-menu-link">
             <div class="sl-menu-item">
                 <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
                 <span class="menu-item-label">Create a Post</span>
             </div><!-- menu-item -->
         </a><!-- sl-menu-link -->
         @php
             $pages = App\Models\Page::where('user_id', Auth::id())->get();
         @endphp

         <a href="#" class="sl-menu-link @yield('pages')">
             <div class="sl-menu-item">
                 <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
                 <span class="menu-item-label">Pages</span>
                 <i class="menu-item-arrow fa fa-angle-down"></i>
             </div><!-- menu-item -->
         </a><!-- sl-menu-link -->
         <ul class="sl-menu-sub nav flex-column">
             @foreach ($pages as $page)
                 <li class="nav-item"><a href="{{ route('page-post', ['pageId' => $page->id]) }}"
                         class="nav-link">{{ $page->page_name }}</a>
                 </li>
             @endforeach


         </ul>




     </div><!-- sl-sideleft-menu -->

     <br>
 </div><!-- sl-sideleft -->
 <!-- ########## END: LEFT PANEL ########## -->
