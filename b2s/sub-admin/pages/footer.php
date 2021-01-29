<!-- ============================================================== -->

            <!-- footer -->

            <!-- ============================================================== -->

            <footer class="footer">

               جميع الحقوق محفوظة لـ سلتكم 

            </footer>

            <!-- ============================================================== -->

            <!-- End footer -->

            <!-- ============================================================== -->

        </div>

        <!-- ============================================================== -->

        <!-- End Page wrapper  -->

        <!-- ============================================================== -->

    </div>

    <!-- ============================================================== -->

    <!-- End Wrapper -->

    <!-- ============================================================== -->

    <!-- ============================================================== -->

    <!-- All Jquery -->

    <!-- ============================================================== -->

    <script data-cfasync="false" src="//cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="../assets/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap tether Core JavaScript -->

 

    <!-- ============================================================== -->

    <!-- This page plugins -->

    <!-- ============================================================== -->

    <!-- chartist chart -->

    <script src="../assets/plugins/chartist-js/dist/chartist.min.js"></script>

    <script src="../assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script>

    <!-- Chart JS -->

    <script src="../assets/plugins/echarts/echarts-all.js"></script>

    <script src="../assets/plugins/toast-master/js/jquery.toast.js"></script>

    <!-- Chart JS -->

    <script src="../js/dashboard1.js"></script>

    <script src="../js/toastr.js"></script>

    <script>

    $.toast({

        heading: 'مرحبا بالمدير',

        text: 'استخدم المحددات المحددة مسبقًا ، أو حدد موضع مخصص',

        position: 'top-right',

        loaderBg: '#ff6849',

        icon: 'info',

        hideAfter: 3000,

        stack: 6

    });

    </script>

    <!-- ============================================================== -->

    <!-- Style switcher -->

    <!-- ============================================================== -->

    <script src="../assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>

    

    

    <script src="../assets/plugins/bootstrap/js/popper.min.js"></script>

    <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- slimscrollbar scrollbar JavaScript -->

    <script src="../js/jquery.slimscroll.js"></script>

    <!--Wave Effects -->

    <script src="../js/waves.js"></script>

    <!--Menu sidebar -->

    <script src="../js/sidebarmenu.js"></script>

    <!--stickey kit -->

    <!--<script src="../assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>-->

    <!--Custom JavaScript -->

    <script src="../js/custom.min.js"></script>

    <!-- This is data table -->

    <script src="../assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>

    <script src="../assets/plugins/datatables.net-bs4/js/dataTables.responsive.min.js"></script>

    <!-- start - This is for export functionality only -->

    <script src="//cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>

    <script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>

    <script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>

    <script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>

    <script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>

    <script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>

    <!-- end - This is for export functionality only -->

    <script>

        $(function () {

            $('#myTable').DataTable();

            // responsive table

            $('#config-table').DataTable({

                responsive: true

            });

            var table = $('#example').DataTable({

                "columnDefs": [{

                    "visible": false,

                    "targets": 2

                }],

                "order": [

                    [2, 'asc']

                ],

                "displayLength": 25,

                "drawCallback": function (settings) {

                    var api = this.api();

                    var rows = api.rows({

                        page: 'current'

                    }).nodes();

                    var last = null;

                    api.column(2, {

                        page: 'current'

                    }).data().each(function (group, i) {

                        if (last !== group) {

                            $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');

                            last = group;

                        }

                    });

                }

            });

            // Order by the grouping

            $('#example tbody').on('click', 'tr.group', function () {

                var currentOrder = table.order()[0];

                if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {

                    table.order([2, 'desc']).draw();

                } else {

                    table.order([2, 'asc']).draw();

                }

            });



            $('#example23').DataTable({

                dom: 'Bfrtip',

                buttons: [

                    'copy', 'csv', 'excel', 'pdf', 'print'

                ]

            });

            $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');

        });



    </script>

</body>



</html>