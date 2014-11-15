<!DOCTYPE html>
<html>
  <head>
    <title>SyncTimer</title>
    @section('stylesheets')
      <link rel="stylesheet" href="/assets/foundation/css/normalize.css" />
      <link rel="stylesheet" href="/assets/foundation/css/foundation.css" />
      <link rel="stylesheet" href="/assets/foundation-datepicker/stylesheets/foundation-datepicker.css" />
      <link rel="stylesheet" href="/assets/foundation-icon-fonts/foundation-icons.css" />

      <link rel="stylesheet" href="/assets/app/css/app.css" />
    @show

    <script src="/assets/foundation/js/vendor/modernizr.js"></script>
  </head>
  <body>
    <nav class='top-bar' data-topbar role='navigation'>
      <ul class='title-area'>
        <li class='name'>
          <h1><a href='#'>SyncTimer</a></h1>
        </li>
      </ul>
      <section class='top-bar-section'>
        <ul class='left'>
          <li><a href='{{ action('TimerController@index') }}'>Timers</a></li>
        </ul>
      </section>
    </nav>

    @yield('content')

    @section('scripts')
      <script src="/assets/moment/moment.js"></script>
      <script src="/assets/foundation/js/vendor/jquery.js"></script>
      <script src="/assets/foundation/js/foundation.min.js"></script>
      <script src="/assets/foundation-datepicker/js/foundation-datepicker.js"></script>
      <script src="/assets/app/js/app.js"></script>
      <script>
        $(document).foundation();
      </script>
    @show
  </body>
</html>
