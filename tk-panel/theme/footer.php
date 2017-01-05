   <!-- js placed at the end of the document so the pages load faster -->
    <script src="/tk-panel/theme/js/jquery.js"></script>
    <script src="/tk-panel/theme/js/jquery-1.8.3.min.js"></script>
    <script src="/tk-panel/theme/js/bootstrap.min.js"></script>
    <script src="/tk-panel/theme/js/jquery.scrollTo.min.js"></script>
    <script src="/tk-panel/theme/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="/tk-panel/theme/js/jquery.sparkline.js" type="text/javascript"></script>
    <script src="/tk-panel/theme/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
    <script src="/tk-panel/theme/js/owl.carousel.js" ></script>
    <script src="/tk-panel/theme/js/jquery.customSelect.min.js" ></script>

    <!--common script for all pages-->
    <script src="/tk-panel/theme/js/common-scripts.js"></script>
    <script src="/tk-panel/theme/js/sweetalert.min.js"></script>
    <!--script for this page-->
    <script src="/tk-panel/theme/js/sparkline-chart.js"></script>
    <script src="/tk-panel/theme/js/easy-pie-chart.js"></script>
	<script>
	 var ajax_url = 'http://<?=$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];?>&ajax=';
	 </script>
	 
   <script type="text/javascript" src="/tk-panel/theme/assets/data-tables/jquery.dataTables.js"></script>
   <script type="text/javascript" src="/tk-panel/theme/assets/data-tables/DT_bootstrap.js"></script>
    <!--script for this page only-->
    <script src="/tk-panel/theme/js/dynamic-table.js"></script>
	
    <script src="/tk-panel/theme/js/novinCompany.js"></script>
	 <script src="/tk-panel/theme/assets/ckeditor/ckeditor.js"></script>
	 
  <script>

      //owl carousel

      $(document).ready(function() {
          $("#owl-demo").owlCarousel({
              navigation : true,
              slideSpeed : 300,
              paginationSpeed : 400,
              singleItem : true

          });
      });

      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });
	   CKEDITOR.replace( 'editor1', {
             language: 'fa',
             font: 'wyekan',
                });
    

  </script>
  
  <?php if(isset($msg)){echo $msg;}?>
  <div id="result_show" > </div>
  </body>
</html>