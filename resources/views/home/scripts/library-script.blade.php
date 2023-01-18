<script>
    window.onload = function() {
        var type = $('.lib-tab-headers.active').attr('data-val');
        var tabClass = $('.lib-tab-headers.active').attr('data-cl');
        getLibrarySections(type,tabClass);  
    };

    function getLibrarySections(type='',tabClass='')
    {
        $('#lib-tab-content').html(' ');
        $('.lib-tab-headers').removeClass('active');
        $('.lib-tab-headers.'+tabClass).addClass('active');

        $.ajax({
            type: 'get',
            url: '{{ URL("library-tabs") }}',
            data: { type: type },
            dataType: 'JSON',
            success: function (data) {
                $('#lib-tab-content').html(data.html);
                if($(".image-galary").length == 8){
                    $("#load-lib").css('display','block')
                }else{
                    $("#load-lib").css('display','none')
                    

                }
            }
        });
    }
</script>