<footer class="footer" id="footer">
    <div class="container">
        <br>
        <div class="row">
            <div class="col-12">
                <h4 style="color: white" class="font-weight-bold"><img src="../static/elements/logo/favicon-32x32.png" height="32">
                    ฝ่ายเภสัชกรรม โรงพยาบาลศรีนครินทร์</h4>
                <hr>
            </div>
            <div class="col-md-3">
                <h5 style="color: white" class="font-weight-bold">เกี่ยวกับ</h5>
                <ul>
                    <li style="color: lime"><a href="../post/3" style="color: white">โครงสร้างการบริหาร</a></li>
                    <li style="color: lime"><a href="../post/4" style="color: white">ผู้บริหาร</a></li>
                    <li style="color: lime"><a href="../post/5" style="color: white">คณะกรรมการเภสัชกรรม</a></li>
                    <li style="color: lime"><a href="../post/6" style="color: white">คณะอนุกรรมการพิจารณายา</a></li>
                    <li style="color: lime"><a href="../post/7" style="color: white">คณะอนุกรรมการพัฒนาระบบยา</a></li>
                </ul>
                <h5 style="color: white" class="font-weight-bold">หน่วยงาน</h5>
                <ul>
                    <li style="color: lime"><a style="color: white" href="../category/manufacture-1">งานผลิตยา</a></li>
                    <li style="color: lime"><a style="color: white" href="../category/service-1">งานบริการจ่ายยา</a></li>
                    <li style="color: lime"><a style="color: white" href="../category/DIC-1">งานเภสัชสนเทศทางยา</a></li>
                    <li style="color: lime"><a style="color: white" href="../category/inventory-1">งานบริหารคลังยาและเวชภัณฑ์</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h5 style="color: white" class="font-weight-bold">ข่าวสาร</h5>
                <ul>
                    <li style="color: lime"><a style="color: white" href="../category/news-1">ข่าวประชาสัมพันธ์</a></li>
                    <li style="color: lime"><a style="color: white" href="../category/order-1">คำสั่ง</a></li>
                    <li style="color: lime"><a style="color: white" href="../category/announce-1">ประกาศ</a></li>
                    <li style="color: lime"><a style="color: white" href="../category/guideline-1">ระเบียบ - แนวทางปฏิบัติ</a></li>
                    <li style="color: lime"><a style="color: white" href="../category/manual-1">คู่มือการใช้ยา</a></li>
                    <li style="color: lime"><a style="color: white" href="../category/research-1">ผลงานวิจัยและ R2R</a></li>
                </ul>
                <p style="color: white" href="../category/news-1"> ชุมชนนักปฏิบัติ <a style="color: white" href="../category/CoPADR-1">ADR</a> | <a style="color: white" href="../category/CoPHAD-1">HAD</a> | <a style="color: white" href="../category/CoPME-1">ME</a> | <a style="color: white" href="../category/CoPRDU-1">RDU</a>
                    <br><a style="color: white" href="../download/"> ดาวน์โหลดแบบฟอร์ม </a>
                    <br><a style="color: white" href="../forum/"> กระดานถาม - ตอบ </a>    
                </p> 
            </div>
            <div class="col-md-3">
                <h5 style="color: white" class="font-weight-bold">ติดต่อ</h5>
                <p style="color:white">ฝ่ายเภสัชกรรม
                    <br>คณะแพทยศาสตร์ มหาวิทยาลัยขอนแก่น
                    <br>123 ถนนมิตรภาพ ตำบลในเมือง
                    <br>อำเภอเมืองขอนแก่น จังหวัดขอนแก่น 40000
                    <br>
                    <br>โทรศัพท์ <a href="tel:+6643363280" style="color: white">043-363280</a><br>โทรสาร 043-348403<br>
                </p>
            </div>
            <div class="col-md-3">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d804.3464799894232!2d102.83058103402773!3d16.46853701588352!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x94b11407a41dfeea!2z4LmC4Lij4LiH4Lie4Lii4Liy4Lia4Liy4Lil4Lio4Lij4Li14LiZ4LiE4Lij4Li04LiZ4LiX4Lij4LmM!5e0!3m2!1sth!2sth!4v1603357481171!5m2!1sth!2sth" width="100%" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12 text-center mb-2">
                <h6 style="color: white;">Copyright 2020 &copy; Pharmacy Department - Srinagarind Hospital. All Right Reserved. &nbsp;Made with ❤ by <a href="https://www.pondja.com">PondJaᵀᴴ</a></h6>
            </div>
        </div>
    </div>
</footer>

<!--div class="loader"></div-->

<script type="text/javascript">
    // Tooltips Initialization
    $(document).ready(function () {
        $('.mdb-select').materialSelect();
        $('[data-toggle="tooltip"]').tooltip();
        $('.btn-floating').unbind('click');
        $('.fixed-action-btn').unbind('click');
        //$(".loader").delay(1500).fadeOut("slow");
    });

    if ($(document.body).height() < $(window).height()) {
        $('#footer').attr('style', 'position: fixed!important; bottom: 0px;');
    } else {
        $('#footer').removeAttr('style');
    }

    $(window).on('resize', function() {
        if ($(document.body).height() < $(window).height()) {
            $('#footer').attr('style', 'position: fixed!important; bottom: 0px;');
        } else {
            $('#footer').removeAttr('style');
        }
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

    $('input[type=text], input[type=password], input[type=email], input[type=url], input[type=tel], input[type=number], input[type=search], input[type=date], input[type=time], textarea').each(function (element, i) {
        if ((element.value !== undefined && element.value.length > 0) || $(this).attr('placeholder') !== undefined) {
            $(this).siblings('label').addClass('active');
        } else {
            $(this).siblings('label').removeClass('active');
        }});
    $('input[type=email]').val('test').siblings('label').addClass('active');
</script>

<div id="fb-root"></div><script async defer crossorigin="anonymous" src="https://connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v7.0&appId=2529205720433288&autoLogAppEvents=1" nonce="2UGIjGvo"></script>

<?php $_SESSION['isDarkProfile'] = 0; ?>
<?php mysqli_close($conn); ?>