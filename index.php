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

  <body ng-app="prinuk" ng-controller="homeCtrl" ng-cloak>

    <div class="container" ng-cloak>
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
          <!-- <a class="p-2 text-muted" href="#">Visits</a> -->
        </nav>
      </div>

      <div class="jumbotron p-3 p-md-5 text-white rounded bg-dark">
        <div class="col-md-12 px-0" ng-repeat = "event in featured_events | filter: main_featured">
          <h1 class="display-4 font-italic">{{event.title}}</h1>
          <p class="lead my-3">{{event.description}}</p>
          <p class="lead mb-0"><a href="/event.php?id={{event.id}}" class="text-white font-weight-bold">Continue reading...</a></p>
        </div>
      </div>

      <div class="row mb-2">
        <div class="col-md-6" ng-repeat = "event in featured_events | filter: others_featured">
          <div class="card flex-md-row mb-4 box-shadow h-md-250">
            <div class="card-body d-flex flex-column align-items-start">
              <strong class="d-inline-block mb-2 text-primary">{{event.type}}</strong>
              <h3 class="mb-0">
                <a class="text-dark" href="/event.php?id={{event.id}}">{{event.title}}</a>
              </h3>
              <div class="mb-1 text-muted">{{event.event_date}}</div>
              <p class="card-text mb-auto">{{event.description}}</p>
              <a href="/event.php?id={{event.id}}">Continue reading</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <main role="main" class="container">
      <div class="row">
        <div class="col-md-8 blog-main">
          <h5 class="pb-3 mb-4">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="upcoming-tab" ng-click="tab_click('event_time')" data-toggle="tab" role="tab" href="#upcoming" aria-controls="upcoming" aria-selected="true">Upcoming Events</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="recently-tab" ng-click="tab_click('created_time')" data-toggle="tab" role="tab" href="#recently" aria-controls="recently" aria-selected="false">Recently Added Events</a>
              </li>
            </ul>
          </h5>
          <div class="all_blogs" ng-repeat="event in all_events">
            <div class="blog-post">
              <strong class="d-inline-block mb-2 text-primary">{{event.name}}</strong>
              <h5 class="blog-post-title"><a href="/event.php?id={{event.id}}">{{event.event_title}}</a></h5>
              <p class="blog-post-meta">Dates: <b>{{event.event_start_date}}</b> to <b>{{event.event_end_date}}</b></p>
              <p ng-repeat="description in split_description(event.short_description)">
                {{event.short_description}}
              </p>
              <a href="/event.php?id={{event.id}}">Continue Reading...</a>
            </div><!-- /.blog-post -->
          </div>

          <nav class="blog-pagination">
            <button class="btn btn-outline-primary" ng-click="get_more_events()" ng-disabled="button_active">Show More</button>
          </nav>

        </div><!-- /.blog-main -->

        <aside class="col-md-4 blog-sidebar">
          <div class="p-3 mb-3 bg-light rounded">
            <h4 class="font-italic">About</h4>
            <p class="mb-0">While living in the UK I realize it was so hard to find and
              keep track of events I was finding online. So I decided to create this page to
              aggregate all the events in one place to make them easy to find.</p>
          </div>

          <div class="p-3">
            <h4 class="font-italic">Search Events!</h4>
            <form>
              <input id="search" type="text" placeholder="Search..." style="width:100%" name="search">
            </form>
            <br/>
            <form>
              <div class="form-group">
                <label for="town_select">Select Town (select one):</label>
                <select class="form-control" id="town_select">
                  <option></option>
                  <option ng-repeat="town in towns" value="{{town.town}}">{{town.town}}</option>
                </select>
              </div>
            </form>
            <form>
              <div class="form-group">
                <label for="county_select">Select county (select one):</label>
                <select class="form-control" id="county_select">
                  <option></option>
                  <option ng-repeat="county in counties" value="{{county.county}}">{{county.county}}</option>
                </select>
              </div>
            </form>
            <form>
              <div class="form-group">
                <label for="type_select">Select event type (select one):</label>
                <select class="form-control" id="type_select">
                  <option></option>
                  <option ng-repeat="type in types" value="{{type.id}}">{{type.name}}</option>
                </select>
              </div>
            </form>
            <label for="date_pickers">Select Timeframe:</label>
            <p id="date_pickers"><input type="text" id="datepickerFrom"> to </p>
            <p><input type="text" id="datepickerTo"></p>
            <div class="row">
              <div class="col-md-4">
                <button type="button" ng-click="search()" class="btn btn-primary">Submit</button>
              </div>
              <div class="col-md-4">
                <button type="button" ng-click="clear_search()" class="btn btn-default">Clear</button>
              </div>
            </div>
          </div>

          <!--
          <div class="p-3">
            <h4 class="font-italic">Elsewhere</h4>
            <ol class="list-unstyled">
              <li><a href="#">GitHub</a></li>
              <li><a href="#">Twitter</a></li>
              <li><a href="#">Facebook</a></li>
            </ol>
          </div> -->
        </aside> <!-- /.blog-sidebar -->

      </div><!-- /.row -->

    </main><!-- /.container -->

    <footer class="blog-footer">
      <p>Blog template built for <a href="https://getbootstrap.com/">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>.</p>
      <p>
        <a href="#">Back to top</a>
      </p>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="/dist/js/lib/jquery-ui.js"></script>
    <script src="/dist/js/lib/popper.min.js"></script>
    <script src="/dist/js/lib/bootstrap.min.js"></script>
    <script src="/dist/js/lib/holder.min.js"></script>
    <script src="/dist/js/home.js"></script>

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
