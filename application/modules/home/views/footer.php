<!-- <script src="common/js/jquery-1.11.0.min.js">
</script>-->

<style>
/**** Chat Popup Layout******/
.msg_box{
	position:fixed;
	bottom:-5px;
	width:250px;
	background:white;
	border-radius:5px 5px 0px 0px;
	z-index: 10;
	overflow-x: auto;
}

.msg_head{	
	background:black;
	color:white;
	padding:8px;
	font-weight:bold;
	cursor:pointer;
	border-radius:5px 5px 0px 0px;
}

.msg_body{
	background:white;
	height:200px;
	font-size:12px;
	padding:15px;
	overflow:auto;
	overflow-x: hidden;
}
.msg_input{
	width:100%;
	height: 55px;
	border: 1px solid white;
	border-top:1px solid #DDDDDD;
	-webkit-box-sizing: border-box; 
	-moz-box-sizing: border-box;   
	box-sizing: border-box;  
}

.close{
	float:right;
	cursor:pointer;
}
.minimize{
	float:right;
	cursor:pointer;
	padding-right:5px;
	
}

.msg-left{
	position:relative;
	background:#e2e2e2;
	padding:5px;
	min-height:10px;
	margin-bottom:5px;
	margin-right:10px;
	border-radius:5px;
	word-break: break-all;
	z-index: 10;
	overflow-x: auto;
}

.msg-right{
	background:#d4e7fa;
	padding:5px;
	min-height:15px;
	margin-bottom:5px;
	position:relative;
	margin-left:10px;
	border-radius:5px;
	word-break: break-all;
	z-index: 10;
	overflow-x: auto;
}
.user{
	position:relative;
	padding:5px 30px;
	z-index: 10;
	overflow-x: auto;
}

.user:before{
	content:'';
	position:absolute;
	background:#2ecc71;
	height:10px;
	width:10px;
	left:10px;
	top:15px;
	border-radius:6px;
	z-index: 10;
	overflow-x: auto;
}

/**** Slider Layout Popup *********/

 #chat-sidebar {
	position:fixed;
	right:0px;
	bottom:0px;
	width:250px;
	background-color:#fff ;
	  overflow-x: auto;
	  z-index: 10;
}
.chat_body{
	background:white;
	height:auto;
	padding:5px 0px;
}

.chat_head,.msg_head{
	background:#f39c12;
	color:white;
	padding:15px;
	font-weight:bold;
	cursor:pointer;
	border-radius:5px 5px 0px 0px;
}

 #sidebar-user-box {
     padding: 4px;
     margin-bottom: 4px;
     font-size: 15px;
     font-family: Calibri;
     font-weight:bold;
     cursor:pointer;
}
 #sidebar-user-box:hover {
     background-color:#999999 ;
}
 #sidebar-user-box:after {
     content: ".";
     display: block;
     height: 0;
     clear: both;
     visibility: hidden;
}
 img{
     width:35px;
     height:35px;
     border-radius:50%;
     float:left;
}
 #slider-username{
     float:left;
     line-height:30px;
     margin-left:5px;
}
 

.foot2 {
   position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;
   text-align: center;
}
</style>
<!--
<div id="chat-sidebar">
	<div class="chat_head">Chat Messenger (<?php echo $this->ion_auth->user()->row()->username; ?>)</div>
	<div class="chat_body"> 

<?php 
//$ct = $this->session->userdata('__ci_last_regenerate');
$last_log = strtotime('now -8 hours');

		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('last_login <',$last_log);
		$query = $this->db->get();
		//return $query->result();

foreach ($query->result() as $row){ 
   // file_put_contents('filename.txt', print_r($query, true));
?>
<div id="sidebar-user-box" class="<?php echo $row->id; ?>" >
<span class="user"  id="slider-username"><?php echo $row->username; ?> </span>
</div>	

	<?php }
?>


</div>
</div>	-->
<footer class="site-footer " >
    <div class="text-center">
        <?php echo date('Y'); ?> &copy; <?php echo $this->db->get('settings')->row()->system_vendor; ?> by <a href="https://ispecsappeal.com" target="_blank" style="color:red;"> <b>I-specs Appeal Jamaica</b> </a>
        <a href="<?php echo current_url() . '#'; ?>" class="go-top">
            <i class="fa fa-angle-up"></i>
        </a>
    </div>    

	
</footer>
<!--footer end-->
</section>



<!-- js placed at the end of the document so the pages load faster -->
<script src="common/js/jquery.js"></script>
<script src="common/js/jquery-1.8.3.min.js"></script>
<script src="common/js/jquery.menu.js"></script>

<script src="common/js/bootstrap.min.js"></script>
<script src="common/js/jquery.scrollTo.min.js"></script>

<script src="common/js/moment.min.js"></script>

<!--
<script src="common/js/jquery.nicescroll.js" type="text/javascript"></script>
-->
<script type="text/javascript" src="common/assets/DataTables/datatables.min.js"></script>
<script src="common/js/respond.min.js" ></script>
<script type="text/javascript" src="common/assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="common/assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="common/assets/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
<script type="text/javascript" src="common/assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<script type="text/javascript" src="common/assets/jquery-multi-select/js/jquery.multi-select.js"></script>
<script type="text/javascript" src="common/assets/jquery-multi-select/js/jquery.quicksearch.js"></script>
<script type="text/javascript" src="common/assets/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="common/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
<script src="common/js/advanced-form-components.js"></script>
<script src="common/js/jquery.cookie.js"></script>
<!--common script for all pages--> 
<script src="common/js/common-scripts.js"></script>
<script src="common/js/lightbox.js"></script>
<script class="include" type="text/javascript" src="common/js/jquery.dcjqaccordion.2.7.js"></script>
<script class="include" type="text/javascript" src="common/js/jquery.ui.touch-punch.min.js"></script>
<!--script for this page only-->
<script src="common/js/editable-table.js"></script>
<script src="common/assets/fullcalendar/fullcalendar.js"></script>
<script type="text/javascript" src="common/js/selectize.min.js"></script>
  <script src="common/js/jquery.chained.js" type="text/javascript" ></script>

<script>
 var arr = []; // List of users	
 
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}

		$(document).on('click', '#chat-sidebar', function() {	
		//$('.chat_head').click(function(){
		$('.chat_body').slideToggle('slow');
	});
	
	$(document).on('click', '.msg_head', function() {	
		var chatbox = $(this).parents().attr("rel") ;
		$('[rel="'+chatbox+'"] .msg_wrap').slideToggle('slow');
		return false;
	});
	
	$(document).on('click', '.close', function() {	
		var chatbox = $(this).parents().parents().attr("rel") ;
		$('[rel="'+chatbox+'"]').hide();
		arr.splice($.inArray(chatbox, arr), 1);
		displayChatBox();
		return false;
	});
		$(document).on('click', '#sidebar-user-box', function() {
	
	 var userID = $(this).attr("class");
	 var username = $(this).children().text() ;
	 
	 if ($.inArray(userID, arr) != -1)
	 {
      arr.splice($.inArray(userID, arr), 1);
     }
	 
	 arr.unshift(userID);
	 chatPopup =  '<div class="msg_box" style="right:270px" rel="'+ userID+'">'+
					'<div class="msg_head">'+username +
					'<div class="close">x</div> </div>'+
					'<div class="msg_wrap"> <div class="msg_body"><div class="msg_push"></div> </div>'+
					'<div class="msg_footer"><textarea class="msg_input" rows="4"></textarea></div> 	</div> 	</div>' ;					
				
     $("body").append(  chatPopup  );
	 displayChatBox();
	});
	$(document).on('keypress', 'textarea' , function(e) {       
        if (e.keyCode == 13 ) { 		
            var msg = $(this).val();		
			$(this).val('');
			if(msg.trim().length != 0){				
			var chatbox = $(this).parents().parents().parents().attr("rel") ;
			$('<div class="msg-right">'+msg+'</div>').insertBefore('[rel="'+chatbox+'"] .msg_push');
			$('.msg_body').scrollTop($('.msg_body')[0].scrollHeight);
			}
        }
    });
	function displayChatBox(){ 
	    i = 270 ; // start position
		j = 260;  //next position
		
		$.each( arr, function( index, value ) {  
		   if(index < 4){
	         $('[rel="'+value+'"]').css("right",i);
			 $('[rel="'+value+'"]').show();
		     i = i+j;			 
		   }
		   else{
			 $('[rel="'+value+'"]').hide();
		   }
        });		
	}
			
</script>



<script type="text/javascript" src="common/assets/bootstrap-fileupload/bootstrap-fileupload.js"></script>
		<script type="text/javascript" src="common/assets/plugins/jquery-validation/js/jquery.validate.min.js"></script>
		<script type="text/javascript" src="common/assets/plugins/jquery-validation/js/additional-methods.min.js"></script>
		<script type="text/javascript" src="common/assets/plugins/bootstrap-toastr/toastr.min.js"></script>
		<script type="text/javascript">
			(function($){
				toastr.options = {
					"closeButton": true,
					"debug": false,
					"positionClass": "toast-bottom-right",
					"onclick": null,
					"showDuration": "1000",
					"hideDuration": "1000",
					"timeOut": "5000",
					"extendedTimeOut": "1000",
					"showEasing": "swing",
					"hideEasing": "linear",
					"showMethod": "fadeIn",
					"hideMethod": "fadeOut"
				};

				$(".login-form").validate({
					rules : {
						username : "required",
						password : "required",
					},
					submitHandler : function(form){
						$.post($(form).attr("action"),$(form).serialize()).done(function(response){
							if(response.status){
								window.location.href = "<?php echo site_url("admin/dashboard"); ?>"
							}else{
								toastr["error"](response.message);
							}
						});
					}
				});
			}(jQuery));
		</script>

<?php
$language = $this->db->get('settings')->row()->language;

if ($language == 'english') {
    $lang = 'en';
} elseif ($language == 'spanish') {
    $lang = 'es';
} elseif ($language == 'french') {
    $lang = 'fr';
} elseif ($language == 'portuguese') {
    $lang = 'pt';
} elseif ($language == 'arabic') {
    $lang = 'ar';
} elseif ($language == 'italian') {
    $lang = 'it';
}
?>



<script src='common/assets/fullcalendar/locale/<?php echo $lang; ?>.js'></script>



<style>

</style>






<script>
    $('.multi-select').multiSelect({
        selectableHeader: "<input type='text' class='search-input' autocomplete='off' placeholder=' search...'>",
        selectionHeader: "<input type='text' class='search-input' autocomplete='off' placeholder=''>",
        afterInit: function (ms) {
            var that = this,
                    $selectableSearch = that.$selectableUl.prev(),
                    $selectionSearch = that.$selectionUl.prev(),
                    selectableSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selectable:not(.ms-selected)',
                    selectionSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selection.ms-selected';

            that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                    .on('keydown', function (e) {
                        if (e.which === 40) {
                            that.$selectableUl.focus();
                            return false;
                        }
                    });

            that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                    .on('keydown', function (e) {
                        if (e.which == 40) {
                            that.$selectionUl.focus();
                            return false;
                        }
                    });
        },
        afterSelect: function () {
            this.qs1.cache();
            this.qs2.cache();
        },
        afterDeselect: function () {
            this.qs1.cache();
            this.qs2.cache();
        }
    });
</script>

<script>
    $('#my_multi_select3').multiSelect()
</script>

<script>
    $('.default-date-picker').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true
    });


    $('#date').on('changeDate', function () {
        $('#date').datepicker('hide');
    });

    $('#date1').on('changeDate', function () {
        $('#date1').datepicker('hide');
    });


</script>


<script type="text/javascript">

    $(document).ready(function () {
        $('#calendar').fullCalendar({
            lang: 'en',
            events: 'appointment/getAppointmentByJason',
            header:
                    {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay',
                    },
            /*    timeFormat: {// for event elements
             'month': 'h:mm TT A {h:mm TT}', // default
             'week': 'h:mm TT A {h:mm TT}', // default
             'day': 'h:mm TT A {h:mm TT}'  // default
             },
             
             */
            timeFormat: 'h(:mm) A',
            eventRender: function (event, element) {
                element.find('.fc-time').html(element.find('.fc-time').text());
                element.find('.fc-title').html(element.find('.fc-title').text());

            },
            eventClick: function (event) {
                $('#medical_history').html("");
                if (event.id) {
                    $.ajax({
                        url: 'patient/getMedicalHistoryByJason?id=' + event.id + '&from_where=calendar',
                        method: 'GET',
                        data: '',
                        dataType: 'json',
                    }).success(function (response) {
                        // Populate the form fields with the data returned from server
                        $('#medical_history').html("");
                        $('#medical_history').append(response.view);
                    });
                    //alert(event.id);

                }

                $('#cmodal').modal('show');
            },

            /*   eventMouseover: function (calEvent, domEvent) {
             var layer = "<div id='events-layer' class='fc-transparent' style='position:absolute; width:100%; height:100%; top:-1px; text-align:right; z-index:100'>Description</div>";
             $(this).append(layer);
             },
             
             eventMouseout: function (calEvent, domEvent) {
             $(this).append(layer);
             },
             
             */

            slotDuration: '00:5:00',
            businessHours: false,
            slotEventOverlap: false,
            editable: false,
            selectable: false,
            lazyFetching: true,
            minTime: "6:00:00",
            maxTime: "24:00:00",
            defaultView: 'month',
            allDayDefault: false,
            displayEventEnd: true,
            timezone: false,

        });
    });

</script>









<script>
    $(document).ready(function () {
        $('.timepicker-default').timepicker({defaultTime: 'value'});

    });
</script>

<script type="text/javascript" src="common/assets/select2/js/select2.min.js"></script>


<script type="text/javascript">

    $(document).ready(function () {
        $(".js-example-basic-single").select2();

        $(".js-example-basic-multiple").select2();
    });

</script>




<script type="text/javascript">

    $(document).ready(function () {
        var windowH = $(window).height();
        var wrapperH = $('#container').height();
        if (windowH > wrapperH) {
            $('#sidebar').css('height', (windowH) + 'px');
        } else {
            $('#sidebar').css('height', (wrapperH) + 'px');
        }
        var windowSize = window.innerWidth;
        if (windowSize < 768) {
            $('#sidebar').removeAttr('style');
        }
    });
    function onElementHeightChange(elm, callback) {
        var lastHeight = elm.clientHeight, newHeight;
        (function run() {
            newHeight = elm.clientHeight;
            if (lastHeight != newHeight)
                callback();
            lastHeight = newHeight;
            if (elm.onElementHeightChangeTimer)
                clearTimeout(elm.onElementHeightChangeTimer);
            elm.onElementHeightChangeTimer = setTimeout(run, 200);
        })();
    }




    onElementHeightChange(document.body, function () {
        var windowH = $(window).height();
        var wrapperH = $('#container').height();
        if (windowH > wrapperH) {
            $('#sidebar').css('height', (windowH) + 'px');
        } else {
            $('#sidebar').css('height', (wrapperH) + 'px');
        }

        var windowSize = $(window).width();
        if (windowSize < 768) {
            $('#sidebar').removeAttr('style');
        }
    });







    $(window).resize(function () {

        if (width == GetWidth()) {
            return;
        }

        width = GetWidth();

        if (width < 600) {
            $('#sidebar').hide();
        } else {
            $('#sidebar').show();
        }

    });


</script>




<script>
    CKEDITOR.replace("description",
            {
                height: 400
            });
</script>

</body>
</html>
