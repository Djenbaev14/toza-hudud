
<div class="app-sidebar-menu">
  <div class="h-100" data-simplebar>

      <!--- Sidemenu -->
      <div id="sidebar-menu">

          <div class="logo-box">
              <a class='logo logo-light' href='{{route('home')}}'>
                  <span class="logo-sm">
                      <img src="{{asset('assets/images/logo-sm.png')}}" alt="" height="22">
                  </span>
                  <span class="logo-lg">
                      <img src="{{asset('assets/images/logo-light.png')}}" alt="" height="24">
                  </span>
              </a>
              <a class='logo logo-dark' href='{{route('home')}}'>
                  <span class="logo-sm">
                      <img src="{{asset('assets/images/logo-sm.png')}}" alt="" height="22">
                  </span>
                  <span class="logo-lg ">
                      <img src="{{asset('assets/images/logo.png')}}" alt="" height="40">
                  </span>
              </a>
          </div>

          <ul id="side-menu">
            @can('Главная страница')
                <li>
                    <a class='tp-link ' href="{{route('home')}}">
                        <img src="{{asset('assets/images/icons/home.png')}}">
                        <span> Главный </span>
                    </a>
                </li>
            @endcan
            @can('Гараж')
                
                <li >
                    <a href="#sidebarGarages" data-bs-toggle="collapse">
                        <img src="{{asset('assets/images/icons/garage.png')}}">
                        <span> Гараж </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse " id="sidebarGarages">
                        <ul class="nav-second-level">
                            @can('Гараж')
                                <li>
                                    <a class='tp-link' href='{{route('garages.index')}}'>Гараж</a>
                                </li>
                            @endcan
                            @can('Добавить гараж')
                                <li >
                                    <a class='tp-link ' href='{{route('garages.create')}}'>Добавить автомобиль</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endcan
            @can('Водители автомобилей')
                <li>
                    <a class='tp-link' href="{{route('motorists.index')}}">
                        <img src="{{asset('assets/images/icons/driver_garage.png')}}">
                        <span> Водители автомобилей </span>
                    </a>
                </li>
            @endcan
            @if (auth()->user()->can('Водитель') || auth()->user()->can('Добавить водитель'))
                <li>
                    <a href="#sidebarDrivers" data-bs-toggle="collapse">
                        <img src="{{asset('assets/images/icons/driver.png')}}">
                        <span> Водители </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarDrivers">
                        <ul class="nav-second-level">
                            @can('Водитель')
                                <li>
                                    <a class='tp-link' href='{{route('drivers.index')}}'>Водители</a>
                                </li>
                            @endcan
                            @can('Добавить водитель')
                                <li>
                                    <a class='tp-link' href='{{route('drivers.create')}}'>Добавить водитель</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endif
            
            @if (auth()->user()->can('Канцтовары') || auth()->user()->can('Запчасти') || auth()->user()->can('Поступления канцтовар') || auth()->user()->can('Поступления запчасти') || auth()->user()->can('Выход канцтовары') || auth()->user()->can('Выход запчасти'))
                <li>
                    <a href="#sidebarProduct" data-bs-toggle="collapse">
                        <img src="{{asset('assets/images/icons/warehouse.png')}}">
                        <span> Склад </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarProduct">
                        <ul class="nav-second-level">
                            @if (auth()->user()->can('Запчасти')  || auth()->user()->can('Поступления запчасти'))
                                <li>
                                    <a href="#sidebarSpare" data-bs-toggle="collapse">
                                        <span> Запчасти </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <div class="collapse" id="sidebarSpare">
                                        <ul class="nav-second-level">
                                            @can('Запчасти')
                                                <li>
                                                    <a class='tp-link' href='{{route('spare-part.index')}}'>Запчасти</a>
                                                </li>
                                            @endcan
                                            @can('Поступления запчасти')
                                                <li>
                                                    <a class='tp-link' href='{{route('purchase-spare-part.index')}}'>Поступления</a>
                                                </li>
                                            @endcan
                                            @can('Выход запчасти')
                                                <li>
                                                    <a class='tp-link' href='{{route('output-spare-part.index')}}'>Расход</a>
                                                </li>
                                            @endcan
                                        </ul>
                                    </div>
                                </li> 
                            @endif
                            @if (auth()->user()->can('Канцтовары') || auth()->user()->can('Поступления канцтовары') )
                                <li>
                                    <a href="#sidebarStationery" data-bs-toggle="collapse">
                                        <span> Канцтовары </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <div class="collapse" id="sidebarStationery">
                                        <ul class="nav-second-level">
                                            @can('Канцтовары')
                                                <li>
                                                    <a class='tp-link' href='{{route('stationery.index')}}'>Канцтовары</a>
                                                </li>
                                            @endcan
                                            @can('Поступления канцтовары')
                                                <li>
                                                    <a class='tp-link' href='{{route('purchase-stationery.index')}}'>Поступления</a>
                                                </li>
                                            @endcan
                                            @can('Выход канцтовары')
                                                <li>
                                                    <a class='tp-link' href='{{route('output-stationery.index')}}'>Расход</a>
                                                </li>
                                            @endcan
                                        </ul>
                                    </div>
                                </li>
                            @endif
                      
                        </ul>
                    </div>
                </li>
            @endif
            @if (auth()->user()->can('Клиенты') || auth()->user()->can('Поставщики'))
                <li>
                    <a href="#sidebarClients" data-bs-toggle="collapse">
                        <img src="{{asset('assets/images/icons/contact.png')}}">
                        <span> Контакты </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarClients">
                        <ul class="nav-second-level">
                            @can('Клиенты')
                                <li>
                                    <a class='tp-link' href='{{route('clients.index')}}'>Клиенты</a>
                                </li>
                            @endcan
                            @can('Поставщики')
                                <li>
                                    <a class='tp-link' href='{{route('suppliers.index')}}'>Поставщики</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endif
            
            {{-- @can('расходование')
                <li>
                    <a class='tp-link' href="{{route('expenditures.index')}}">
                        <img src="{{asset('assets/images/icons/expenditure.png')}}">
                        <span> Расход </span>
                    </a>
                </li>
            @endcan --}}
            @can('услуга')
                <li>
                    <a class='tp-link' href="{{route('services.index')}}">
                        <img src="{{asset('assets/images/icons/service.png')}}">
                        <span> Услуги </span>
                    </a>
                </li>
            @endcan
            @can('договор')
                
                <li >
                    <a href="#sidebarContracts" data-bs-toggle="collapse">
                        <img src="{{asset('assets/images/icons/contract.png')}}">
                        <span> Договори </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse " id="sidebarContracts">
                        <ul class="nav-second-level">
                            @can('услуга')
                                <li>
                                    <a class='tp-link' href='{{route('contracts.index')}}'>Договори</a>
                                </li>
                            @endcan
                            @can('Добавить услуга')
                                <li >
                                    <a class='tp-link ' href='{{route('contracts.create')}}'>Добавить договор</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endcan
            @can('Филиалы')
                <li>
                    <a class='tp-link' href="{{route('branches.index')}}">
                        <img src="{{asset('assets/images/icons/branch.png')}}">
                        <span> Филиалы </span>
                    </a>
                </li>
            @endcan
            
            @if (auth()->user()->can('Пользователи') || auth()->user()->can('Роли'))
                <li>
                    <a href="#sidebarDashboards" data-bs-toggle="collapse">
                        <img src="{{asset('assets/images/icons/users.png')}}">
                        <span> Пользователи </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarDashboards">
                        <ul class="nav-second-level">
                            @can('Пользователи')
                                <li>
                                    <a class='tp-link' href='{{route('users.index')}}'>Пользователи</a>
                                </li>
                            @endcan
                            @can('Роли')
                                <li>
                                    <a class='tp-link' href='{{route('roles.index')}}'>Роли</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endif
            <li>
                <a class='tp-link' href="{{route('profile.index')}}">
                    <img src="{{asset('assets/images/icons/user.png')}}">
                    <span> Профил </span>
                </a>
            </li>
          </ul>

      </div>
      <!-- End Sidebar -->
  </div>
</div>
