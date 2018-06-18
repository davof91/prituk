<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Events & Me Event Page</title>

    <!-- Bootstrap core CSS -->
    <link href="/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/dist/css/fonts.css" rel="stylesheet">
    <link href="/dist/css/blog.css" rel="stylesheet">
    <link href="/dist/css/jquery-ui.css" rel="stylesheet">
    <script src="/dist/js/lib/angular.js"></script>
  </head>

  <body ng-app="prinuk" ng-controller="eventCtrl" class="background-pattern" ng-cloak>

    <div class="container" ng-cloak style="background-color:white; box-shadow: 10px 10px 10px black;">
      <header class="blog-header py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-2 pt-1">

          </div>
          <div class="col-8 text-center">
            <a class="blog-header-logo text-dark" href="/">Events & Me</a>
          </div>
          <div class="col-2 d-flex justify-content-end align-items-center">
            <!-- <div class="search-container">
              <form>
                <input type="text" placeholder="Search.." name="search">
                <button type="submit"><i class="fa fa-search"></i></button>
              </form>
            </div>-->
          </div>
        </div>
      </header>

      <div class="nav-scroller py-1 mb-2">
        <nav class="nav d-flex">
          <a class="p-2 text-muted" href="/">Events</a>
          <!-- <a class="p-2 text-muted" href="#">Visits</a> -->
        </nav>
      </div>
    </div>

    <main role="main" class="container" style="background-color:white; box-shadow: 10px 10px 10px black;">
      <div class="row">
        <div class="col-md-8 blog-main">
          <div class="all_blogs" ng-repeat="e in event">
            <div class="blog-post">
              <strong class="d-inline-block mb-2 text-primary">{{e.name}}</strong>
              <h5 class="blog-post-title">{{e.event_title}}</h5>
              <p class="blog-post-meta">Dates: <b>{{e.event_start_date}}</b> to <b>{{e.event_end_date}}</b></p>
              <p ng-repeat="description in split_description(e.event_description)">
                {{description}}
              </p>
              <p><b>Price: {{e.price}}</b></p>
              <p>More information at: <a href="{{e.event_url}}">{{e.event_url}}</a></p>
            </div><!-- /.blog-post -->
          </div>
        </div><!-- /.blog-main -->

        <aside class="col-md-4 blog-sidebar">
          <div ng-repeat="e in event">
            <div id="map" style="width:100%;height:200px"></div>
            <div><b>{{e.address}}</b></div><br/>
            <div ng-show="e.train"><i class="fa fa-train"></i> Train Station Available</div>
            <br/>
          </div>
          <h4 class="font-italic">Featured Events!</h4>
          <div class="p-3 mb-3 bg-light rounded" ng-repeat="event in featured_events">
            <h5 class="mb-0">
              <a class="text-dark" href="/event.php?id={{event.id}}">{{event.title}}</a>
            </h5>
            <p class="mb-0">{{event.description}}</p>
          </div>
        </aside> <!-- /.blog-sidebar -->

      </div><!-- /.row -->

    </main><!-- /.container -->

    <footer class="blog-footer">
      <p>Developed by TEIA Engineering</p>
    </footer>
    <script>
      window.id = <?php echo $_GET['id']; ?>; //Don't forget the extra semicolon!
    </script>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/dist/js/lib/jquery.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAXT4tuSkbHrpAWriuGrzjH9a75qDFEqPo"></script>
    <script src="/dist/js/lib/jquery-ui.js"></script>
    <script src="/dist/js/lib/popper.min.js"></script>
    <script src="/dist/js/lib/bootstrap.min.js"></script>
    <script src="/dist/js/lib/holder.min.js"></script>
    <script src="/dist/js/event.js"></script>
    <script src="/dist/js/lib/fontawesome.solid.js"></script>
    <script src="/dist/js/lib/fontawesome.js"></script>
    <script>
      Holder.addTheme('thumb', {
        bg: '#55595c',
        fg: '#eceeef',
        text: 'Thumbnail'
      });
    </script>
  </body>
</html>
