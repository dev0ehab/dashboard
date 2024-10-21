<script>
    $(".video_type").on('change', function() {
        if ($(this).val() === 'url') {
            $(".link-wrapper").show();
            $(".upload-wrapper").hide();
            $("#url-link").attr("data-parsley-required", true);
        } else if ($(this).val() === 'upload') {
            $(".link-wrapper").hide();
            $(".upload-wrapper").show();
            $("#url-link").attr("data-parsley-required", false);
        } else {
            $(".link-wrapper").hide();
            $(".upload-wrapper").hide();
            $("#url-link").attr("data-parsley-required", false);
        }
    });

    if ($('.video_type').val() == "url" || $('.video_type').val() == "upload") {
        let $selected = $('.video_type').val();
        $('.' + $selected + '-wrapper').show().siblings("div.hide_div").hide();
    }
</script>

<script>
    $(".about_video_type").on('change', function() {
        if ($(this).val() === 'url') {
            $(".about-link-wrapper").show();
            $(".about-upload-wrapper").hide();
            $("#about-url-link").attr("data-parsley-required", true);
        } else if ($(this).val() === 'upload') {
            $(".about-link-wrapper").hide();
            $(".about-upload-wrapper").show();
            $("#url-link").attr("data-parsley-required", false);
        } else {
            $(".about-link-wrapper").hide();
            $(".about-upload-wrapper").hide();
            $("#about-url-link").attr("data-parsley-required", false);
        }
    });

    if ($('.about_video_type').val() == "url" || $('.about_video_type').val() == "upload") {
        let $selected = $('.about_video_type').val();
        $('.' + $selected + '-wrapper').show().siblings("div.hide_div").hide();
    }
</script>
