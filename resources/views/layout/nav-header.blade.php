  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>

          {{-- <li class="nav-item" id="dropdown-notifications">
            <a href="#notifications-panel" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button">
              <i data-count="0" class="fas fa-bell"></i>
            </a>

            <div class="dropdown-container">
              <div class="dropdown-toolbar">
                <div class="dropdown-toolbar-actions">
                  <a href="#">Mark all as read</a>
                </div>
                <h3 class="dropdown-toolbar-title">Notifications (<span class="notif-count">0</span>)</h3>
              </div>
              <ul class="dropdown-menu">
              </ul>
              <div class="dropdown-footer text-center">
                <a href="#">View All</a>
              </div>
            </div>
          </li>
        </ul> --}}

      <ul class="navbar-nav navbar-no-expand ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown" id="dropdown-notifications">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-bell" data-count="0"></i>
            <span class="badge badge-warning navbar-badge notif-count">0</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="width: 500px;">
            <span class="dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
          </div>
        </li>
      </ul>
  </nav>

  <!-- jQuery -->
<script src="{{asset('public/template/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('public/template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Admin LTE -->
<script src="{{asset('public/dist/js/adminlte.js')}}"></script>
<!-- Demo Js -->
<script src="{{asset('public/dist/js/demo.js')}}"></script>
  <!-- /.navbar -->

  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="//js.pusher.com/3.1/pusher.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <script type="text/javascript">
        var notificationsWrapper   = $('#dropdown-notifications');
        var notificationsToggle    = notificationsWrapper.find('a[data-toggle]');
        var notificationsCountElem = notificationsToggle.find('i[data-count]');
        var notificationsCount     = parseInt(notificationsCountElem.data('count'));
        var notifications          = notificationsWrapper.find('ul.dropdown-menu');

        if (notificationsCount <= 0) {
          notificationsWrapper.show();
        }

        // Enable pusher logging - don't include this in production
        // Pusher.logToConsole = true;

        var pusher = new Pusher(`env('PUSHER_APP_KEY')`, {
          encrypted: true
        });

        // Subscribe to the channel we specified in our Laravel Event
        var channel = pusher.subscribe('kekeruhan');

        // Bind a function to a Event (the full Laravel class)
        channel.bind('App\\Events\\Kekeruhan', function(data) {
          var existingNotifications = notifications.html();
          var newNotificationHtml = `
            <li class="notification active">
                  <div class="media-body">
                    <strong class="notification-title">`+data.message+`</strong>
                    <!--p class="notification-desc">Extra description can go here</p-->
                    <div class="notification-meta">
                      <small class="timestamp">about a minute ago</small>
                    </div>
                  </div>
                </div>
            </li>
          `;
          notifications.html(newNotificationHtml + existingNotifications);

          notificationsCount += 1;
          notificationsCountElem.attr('data-count', notificationsCount);
          notificationsWrapper.find('.notif-count').text(notificationsCount);
          notificationsWrapper.show();
        });
      </script>
