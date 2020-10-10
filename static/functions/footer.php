<footer class="footer" id="footer">
    <div class="container">
        <br>
        <div class="row">
            <div class="col-12">
                <h4 style="color: white"><img src="../static/elements/logo/favicon-32x32.png" height="32">
                    ฝ่ายเภสัชกรรม โรงพยาบาลศรีนครินทร์</h4>
                <hr>
            </div>
            <div class="col-md-3">
                <h5 style="color: white">เกี่ยวกับ</h5>
                <ul>
                    <li style="color: lime"><a href="#" style="color: white">โครงสร้างการบริหาร</a></li>
                    <li style="color: lime"><a href="#" style="color: white">ผู้บริหาร</a></li>
                    <li style="color: lime"><a href="#" style="color: white">คณะกรรมการเภสัชกรรม</a></li>
                    <li style="color: lime"><a href="#" style="color: white">คณะอนุกรรมการพิจารณายา</a></li>
                    <li style="color: lime"><a href="#" style="color: white">คณะอนุกรรมการพัฒนาระบบยา</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h5 style="color: white">หน่วยงาน</h5>
                <ul>
                    <li style="color: lime"><a style="color: white" href="../category/production-1">งานผลิตยา</a></li>
                    <li style="color: lime"><a style="color: white" href="../category/service-1">งานบริการจ่ายยา</a></li>
                    <li style="color: lime"><a style="color: white" href="../category/information-1">งานบริหารสารสนเทศทางยา</a></li>
                    <li style="color: lime"><a style="color: white" href="../category/storage-1">งานบริหารคลังยาและเวชภัณฑ์</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h5 style="color: white">ข่าวสาร</h5>
                <ul>
                    <li style="color: lime"><a style="color: white" href="../category/news-1">ข่าวประชาสัมพันธ์</a></li>
                    <li style="color: lime"><a style="color: white" href="../category/order-1">คำสั่ง</a></li>
                    <li style="color: lime"><a style="color: white" href="../category/announce-1">ประกาศ</a></li>
                    <li style="color: lime"><a style="color: white" href="../category/guideline-1">ระเบียบ - แนวทางปฏิบัติ</a></li>
                    <li style="color: lime"><a style="color: white" href="../category/manual-1">คู่มือการใช้ยา</a></li>
                    <li style="color: lime"><a style="color: white" href="../category/research-1">ผลงานวิจัยและ R2R</a></li>
                </ul>                
            </div>
            <div class="col-md-3">
            <p style="color: white" href="../category/news-1"> ชุมชนนักปฏิบัติ <a style="color: white" href="../category/CoP-ADR-1/">ADR</a> | <a style="color: white" href="../category/CoP-HAD-1/">HAD</a> | <a style="color: white" href="../category/CoP-ME-1/">ME</a> | <a style="color: white" href="../category/CoP-RDU-1/">RDU</a>
                <br><a style="color: white" href="../download/"> ดาวน์โหลดแบบฟอร์ม </a>
                <br><a style="color: white" href="../forum/"> กระดานถาม - ตอบ </a>    
                <br><a class="btn-floating btn-sm btn-info" href="https://www.facebook.com/SMD.KKU" target="_blank"><i class="fab fa-facebook"></i></a><a href="https://www.facebook.com/SMD.KKU" target="_blank" style="color: white">SMD.KKU</a><br>
                <a class="btn-floating btn-sm blue" href="https://www.facebook.com/wearesmd" target="_blank"><i class="fab fa-facebook"></i></a><a href="https://www.facebook.com/wearesmd" target="_blank" style="color: white">WE ARE SMD</a><br>
            </p>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12 text-center">
                <a href="https://www.web-stat.com">
                    <img alt="Web-Stat web statistics" src="https://wts.one/6s/3/1941813.gif" class="mb-1">
                </a>
                <h6 style="color: white;">Copyright 2020 &copy; Pharmaceutical Department - Srinagarind Hospital. All Right Reserved.</h6>
                <h6 style="color: white;">Made with ❤ by <a href="../pages/about.php">PondJaᵀᴴ</a></h6>
            </div>
        </div>
    </div>
</footer>

<script type="text/javascript">
    // Tooltips Initialization
    $(document).ready(function () {
        $('.mdb-select').materialSelect();
        $('[data-toggle="tooltip"]').tooltip();
        $('.btn-floating').unbind('click');
        $('.fixed-action-btn').unbind('click');

        if ($(document.body).height() < $(window).height()) {
            $('#footer').attr('style', 'position: fixed!important; bottom: 0px;');
        }

        $(window).on('resize', function() {
            if ($(document.body).height() < $(window).height()) {
                $('#footer').attr('style', 'position: fixed!important; bottom: 0px;');
            }
        });
    });

    $('.dropdown-menu').find('form').click(function (e) {
        e.stopPropagation();
    });

    $('.carouselCourse').on('slide.bs.carousel', function(e) {
        $('#pNormalCollapse').collapse('hide');
        $('#pJEMSCollapse').collapse('hide');
        $('#sNormalCollapse').collapse('hide');
        $('#sSEMSCollapse').collapse('hide');
        $('#sSCiUSCollapse').collapse('hide');
    });

    $('.carouselsmoothanimated').on('slide.bs.carousel', function(e) {
        $(this).find('.carousel-inner').animate({
            height: $(e.relatedTarget).height()
        }, 500);
    });
</script>

<div id="fb-root"></div><script async defer crossorigin="anonymous" src="https://connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v7.0&appId=2529205720433288&autoLogAppEvents=1" nonce="2UGIjGvo"></script>

<?php $_SESSION['isDarkProfile'] = 0; ?>
<?php mysqli_close($conn); ?>