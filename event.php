<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Blog Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
    <link href="/dist/css/blog.css" rel="stylesheet">
    <link href="/dist/css/jquery-ui.css" rel="stylesheet">
    <script src="/dist/js/lib/angular.js"></script>
  </head>

  <body ng-app="prinuk" ng-controller="eventCtrl" ng-cloak>

    <div class="container">
      <header class="blog-header py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-4 pt-1">

          </div>
          <div class="col-4 text-center">
            <a class="blog-header-logo text-dark" href="/">PRITUK</a>
          </div>
          <div class="col-4 d-flex justify-content-end align-items-center">
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
        </nav>
      </div>
    </div>

    <main role="main" class="container">
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
          <div id="map" style="width:100%;height:200px"></div>
          <div><b>{{event[0].address}}</b></div><br/>
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
      <p>Blog template built for <a href="https://getbootstrap.com/">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>.</p>
      <p>
        <a href="#">Back to top</a>
      </p>
    </footer>
    <script>
      window.id = <?php echo $_GET['id']; ?>; //Don't forget the extra semicolon!
    </script>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAXT4tuSkbHrpAWriuGrzjH9a75qDFEqPo"></script>
    <script src="/dist/js/lib/jquery-ui.js"></script>
    <script src="/dist/js/lib/popper.min.js"></script>
    <script src="/dist/js/lib/bootstrap.min.js"></script>
    <script src="/dist/js/lib/holder.min.js"></script>
    <script src="/dist/js/event.js"></script>

    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/solid.js" integrity="sha384-+Ga2s7YBbhOD6nie0DzrZpJes+b2K1xkpKxTFFcx59QmVPaSA8c7pycsNaFwUK6l" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/fontawesome.js" integrity="sha384-7ox8Q2yzO/uWircfojVuCQOZl+ZZBg2D2J5nkpLqzH1HY0C1dHlTKIbpRz/LG23c" crossorigin="anonymous"></script>
    <script>
      Holder.addTheme('thumb', {
        bg: '#55595c',
        fg: '#eceeef',
        text: 'Thumbnail'
      });
    </script>
  </body>
</html>
