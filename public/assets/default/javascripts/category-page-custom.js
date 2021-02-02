$(function () {
    $('#order').change(function () {
        var url = window.location.href.replace(/#.*$/, "");
        if(url.indexOf('?') != -1)
            var addon = '&order='+$(this).val();
        else
            var addon = '?order='+$(this).val();
        window.location.href = url+addon;
    })
})
$(function () {
    $('input[type="radio"][name="pricing"]').change(function () {
        var url = window.location.href.replace(/#.*$/, "");
        if(url.indexOf('?') != -1)
            var addon = '&price='+$(this).val();
        else
            var addon = '?price='+$(this).val();
        window.location.href = url+addon;
    })
})
$(function () {
    $('input[type="radio"][name="course"]').change(function () {
        var url = window.location.href.replace(/#.*$/, "");
        if(url.indexOf('?') != -1)
            var addon = '&course='+$(this).val();
        else
            var addon = '?course='+$(this).val();
        window.location.href = url+addon;
    })
})
$(function () {
    $('input[type="checkbox"][name="off"]').change(function () {
        var url = window.location.href.replace(/#.*$/, "");
        if(this.checked)
            var state = 1;
        else
            var state = 0;

        if(url.indexOf('?') != -1)
            var addon = '&off='+state;
        else
            var addon = '?off='+state;
        window.location.href = url+addon;
    })
})
$(function () {
    $('input[type="checkbox"][name="support"]').change(function () {
        var url = window.location.href.replace(/#.*$/, "");
        if(this.checked)
            var state = 1;
        else
            var state = 0;

        if(url.indexOf('?') != -1)
            var addon = '&support='+state;
        else
            var addon = '?support='+state;
        window.location.href = url+addon;
    })
})
$(function () {
    $('input[type="checkbox"][name="post-sell"]').change(function () {
        var url = window.location.href.replace(/#.*$/, "");
        if(this.checked)
            var state = 1;
        else
            var state = 0;

        if(url.indexOf('?') != -1)
            var addon = '&post-sell='+state;
        else
            var addon = '?post-sell='+state;
        window.location.href = url+addon;
    })
})
$(function () {
    $('input[type="checkbox"][name="filters"]').change(function () {
        var url = window.location.href.replace(/#.*$/, "");
        var state = $(this).val();
        if(this.checked) {

            if(url.indexOf('?') != -1)
                var addon = '&filter[]='+state;
            else
                var addon = '?filter[]='+state;
            window.location.href = url+addon;
        }
        else{
            window.location.href = url.replace('filter[]='+state,'');
        }



    })
})
$(function () {
    $('select[name="search_type"]').change(function () {
        var url = window.location.href.replace(/#.*$/, "");
        var state = $(this).val();


        if(url.indexOf('?') != -1)
            var addon = '&type='+state;
        else
            var addon = '?type='+state;
        window.location.href = url+addon;
    })
})
$(function () {
    $('input[type="radio"][name="mode"]').change(function () {
        var url = window.location.href.replace(/#.*$/, "");
        if(url.indexOf('?') != -1)
            var addon = '&mode='+$(this).val();
        else
            var addon = '?mode='+$(this).val();
        window.location.href = url+addon;
    })
})
$(function () {
    $('input[type="checkbox"][name="category"]').change(function () {
        var url = window.location.href.replace(/#.*$/, "");
        var state = $(this).val();
        if(this.checked) {

            if(url.indexOf('?') != -1)
                var addon = '&cat[]='+state;
            else
                var addon = '?cat[]='+state;
            window.location.href = url+addon;
        }
        else{
            window.location.href = url.replace('cat[]='+state,'');
        }



    })
})
