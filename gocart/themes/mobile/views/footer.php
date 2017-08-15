<nav class="bar bar-tab">
  <a class="tab-item active" href="<?php echo site_url();?>">
    <span class="icon icon-home"></span>
    <span class="tab-label">Home</span>
  </a>
  <a class="tab-item" href="<?php echo site_url('secure/my_account');?>">
    <span class="icon icon-person"></span>
    <span class="tab-label">Profile</span>
  </a>
  <a class="tab-item" href="#">
    <span class="icon icon-star-filled"></span>
    <span class="tab-label">Favorites</span>
  </a>
  <a class="tab-item" href="#">
    <span class="icon icon-search"></span>
    <span class="tab-label">Search</span>
  </a>
  <a class="tab-item" href="#">
    <span class="icon icon-gear"></span>
    <span class="tab-label">Settings</span>
  </a>
  <a class="tab-item" href="#">
    <span class="icon icon-gear"></span>
    <span class="tab-label">Settings</span>
  </a>
  <a class="tab-item" href="#">
    <span class="icon icon-gear"></span>
    <span class="tab-label">Settings</span>
  </a>
  <a class="tab-item" href="#">
    <span class="icon icon-gear"></span>
    <span class="tab-label">Settings</span>
  </a>
</nav>

<!-- Settings Modal -->
    <div id="settingsModal" class="modal">
      <header class="bar bar-nav">
        <a class="icon icon-close pull-right" href="#settingsModal"></a>
        <h1 class="title">Settings Example</h1>
      </header>

      <div class="content">
        <form class="input-group">
          <input type="text" placeholder="Full name">
          <input type="email" placeholder="Email">
          <input type="text" placeholder="Username">
        </form>

        <h5 class="content-padded">App settings</h5>

        <ul class="table-view">
          <li class="table-view-cell media">
            <span class="media-object pull-left icon icon-sound"></span>
            <div class="media-body">
              Enable sounds
            </div>
            <div class="toggle">
              <div class="toggle-handle"></div>
            </div>
          </li>
          <li class="table-view-cell media">
            <span class="media-object pull-left icon icon-person"></span>
            <div class="media-body">
              Parental controls
            </div>
            <div class="toggle">
              <div class="toggle-handle"></div>
            </div>
          </li>
        </ul>
        <div class="content-padded">
          <button class="btn btn-positive btn-block">Save settings</button>
        </div>
      </div>
    </div>

<?php echo theme_js('ratchet.js', true);?>
<?php echo theme_js('fingerblast.js', true);?>
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>

<script type='text/javascript'>
    var fb = new FingerBlast ('body');

    $("#login_form").submit(function(event) {
        console.log("IT IS SUMBIT");
        alert( "Handler for .submit() in login called." );
        //event.preventDefault(); // does not do anything (push.js... reloads page)
                
        return;
    });

    $("#register_form").submit(function(event) {
    	//get the action-url of the form
        var actionurl = event.currentTarget.action;
        alert(actionurl);
        
      	//do your own request an handle the results
        $.ajax({
               url: actionurl,
               type: 'post',
               dataType: 'json',
               data: $("#register_form").serialize(),
               success: function(data) {
                    console.log(data);
               }
        });
      	event.preventDefault();             
        //return;
    });


    $( "#save" ).click(function() {
    	  $( "#register_form" ).submit();
    });



</script>

</body>
</html>