
<div id="postgigmodel" class="modal fade  bs-example-modal-lg modelw " tabindex="-1" role="dialog" aria-labelledby="postgigmodel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <section class="postgigform" id="postgigform">
        <h2 id="login1">Post a Gig </h2>
        <h2 class="source">Post a new Gig for free. Invite Gigsters to bid on your gig.</h2>
        <form class="form-horizontal postgigforminner" action="<?php echo $serverpath;?>saveGig" role="form" method="post" id="postform" >
          <div class="form-group">
            <label for="creategig" class="col-sm-2 control-label labelb">Title</label>
            <div class="col-sm-10">
              <input type="text" required class="form-control" id="prjTitle" name="prjTitle" placeholder="Add title for you gig" >
            </div>
          </div>
          <div class="form-group">
            <label for="gigdescription" class="col-sm-2 control-label dis ">Description</label>
            <div class="col-sm-10">
              <textarea class="form-control" id="prjdesc" name="prjdesc" placeholder="Describe your gig" row="5" column="10"  style="height: 150px;"></textarea>
            </div>
          </div>
          <h2 class="loginlead" >How much would you like to pay for the Gig? / How much per hours would you like....</h2>
          <div class="form-group">
            <div class=" col-sm-10 ">

            <div class=" col-sm-4" style="padding:0px;">
               <input type="text" name="proposedprice" id="proposedprice" class="form-control"  placeholder="" onKeyDown="return only_numbers(event);">
            </div>
            <div class=" col-sm-8">               
              <label class="radio-inline">
                <input type="radio" name="jobtype[]" id="jobtype"  value="h"  onChange="change_caption('h')">
              Per Gig </label>
              <label class="radio-inline">
                <input type="radio" name="jobtype[]" id="jobtype" value="f" checked="checked" onChange="change_caption('f')">
                 Per Hour </label>
            </div>    
            </div>
          </div>
          <!-- <h2 class="loginlead" id="mlabel">Whats the best fix price you intend to pay ?</h2>
          <div class="form-group">
            <div class="col-sm-10">
              <input  required style="width:30%" type="text" name="proposedprice" id="proposedprice" class="form-control"  placeholder="" onKeyDown="return only_numbers(event);">
            </div>
          </div> -->
          <h2 class="loginlead" >Skills</h2>
          <div class="form-group">
            <div class="col-sm-10">
              <input  required type="hidden" name="keywords" id="keywords"  class=""    />
            </div>
          </div>
          <h2 class="loginlead">Enter expiry date of your Gig</h2>
          <div class="form-group">
            <div class="col-sm-10">
           
              <input type="text" id="datepic"style="width:47%" name="enddate" class="mdatepicker"/>
               <script type="text/javascript">
          $(document).ready(function(){
          var nowTemp = new Date();
          var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
          var checkin = $('.mdatepicker').datepicker({
               format: 'yy-mm-dd',
                 onRender: function(date) {
                return date.valueOf() < now.valueOf() ? 'disabled' : '';
                 }
               }).on('changeDate', function(ev) {
                 if (ev.date.valueOf() > checkout.date.valueOf()) {
                var newDate = new Date(ev.date)
                newDate.setDate(newDate.getDate() + 1);
                checkout.setValue(newDate);
                 }
                 checkin.hide();     
               }).data('datepicker');
           
                });
         </script>

            </div>
          </div>
          <?php $tags=get_tags();
            $tags=implode(",",$tags);
            ?>
          <script type="text/javascript">$("#keywords").select2({tags:[<?=$tags;?>]});</script>
          <h2 class="loginlead">Would you like to invite your favourite Gigsters to bid?</h2>
          <div class="form-group">
            <div class="col-sm-12 ">
              <label class="radio-inline">
                <input type="radio" name="inviteusers[]" id="inviteusers"  value="1">
                No, please select Gigsters for me</label>
              <label class="radio-inline">
                <input type="radio" name="inviteusers[]" id="inviteusers"  value="0">
                Yes, I will select which Gigsters to bid </label>
            </div>
          </div>
          <div class="form-group submit">
            <button type="submit" class="btn btn-warning">Post Gig</button>
          </div>
        </form>
      </section>
      &nbsp;
      <section class="postgigform mhidden" id="inviteform" style="min-height:400px;overflow:auto;">
        
      </section>
    </div>
  </div>
</div>
