'use strict';

/* Login */
function login(user) {
    setInterval(function () {
        $.get('/login/' + user);
    }, 5 * 60 * 1000);
}

/* Notify */
function customNotify(msg) {
    $.notify({
        message: msg
    }, {
        type: 'danger',
        allow_dismiss: false,
        z_index: '99999999',
        placement: {
            from: "bottom",
            align: "right"
        },
        position: 'fixed'
    });
}

/* Usage */
function usage(product, user) {
    setInterval(function () {
        $.get('/usage/' + product + '/' + user);
    }, 5 * 60 * 1000);
}

/*  Menu Bar  */
$(document).ready(function () {
    $('.has-child').on('mouseenter mouseover', function () {
        let submenu = $(this).children('ul').html();
        $('.menu-header-child ul').html(submenu);
        $('.menu-header-child').fadeIn(100);
    });

    $('.no-child').on('mouseenter mouseover', function () {
        $('.menu-header-child').fadeOut(100);
    });

    $('.menu-header-child').on('mouseenter mouseover', function () {
        $(this).show();
    });

    $('.menu-header-child').on('mouseleave', function () {
        $(this).fadeOut(200);
    });
});

$(window).load(function () {
    $("#header-menu-section").sticky({topSpacing: 0});
    $('#header-menu-section').on('sticky-start', function () {
        $('.menu-logo').fadeIn(300);
    });
    $('#header-menu-section').on('sticky-end', function () {
        $('.menu-logo').fadeOut(100);
    });
});

function openUploaderModal(field) {
    var rand = Math.random().toString(36).substring(7);
    $(field).attr('id', rand);
    $('#uploader-modal iframe').attr('src', '/laravel-filemanager');
    $('#uploader-modal').modal('show');
}

/*$(document).ready(function () {
    $('.click-for-upload').on('click', function () {
        var target = $(this).prev();
        openUploaderModal(target);
    })
});*/

$('#ImageModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var recipient = button.data('whatever');
    var inputUrl = $('input[name=' + recipient + ']').val();
    $(this).find('img').attr('src', inputUrl);
});

$('#VideoModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var recipient = button.data('whatever');
    var inputUrl = $('input[name=' + recipient + ']').val();
    $(this).find('video source').attr('src', inputUrl);
    $($(this).find('video')).load();
});

$('#confirm-delete').on('show.bs.modal', function (e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});

function pagination(selector, perPage, pageNumber) {
    $(selector).children().hide();
    var first = pageNumber * perPage;
    var last = first + perPage;
    for (first; first < last; first++) {
        $(selector).children().eq(first).fadeIn(100);
    }
}

// iosSwitcher
(function ($) {
    if ($.isFunction($.fn.confirmation)) {
        $.extend($.fn.confirmation.Constructor.DEFAULTS, {
            btnOkIcon: 'fa fa-check',
            btnCancelIcon: 'fa fa-times'
        });
    }
}).apply(this, [jQuery]);

(function ($) {
    if (typeof Switch !== 'undefined' && $.isFunction(Switch)) {
        $(function () {
            $('[data-plugin-ios-switch]').each(function () {
                var $this = $(this);
                $this.themePluginIOS7Switch();
            });
        });
    }
}).apply(this, [jQuery]);

(function (theme, $) {
    theme = theme || {};
    var instanceName = '__IOS7Switch';
    var PluginIOS7Switch = function ($el) {
        return this.initialize($el);
    };
    PluginIOS7Switch.prototype = {
        initialize: function ($el) {
            if ($el.data(instanceName)) {
                return this;
            }
            this.$el = $el;
            this
                .setData()
                .build();
            return this;
        },

        setData: function () {
            this.$el.data(instanceName, this);
            return this;
        },

        build: function () {
            var switcher = new Switch(this.$el.get(0));
            $(switcher.el).on('click', function (e) {
                e.preventDefault();
                switcher.toggle();
            });
            return this;
        }
    };

    // expose to scope
    $.extend(theme, {
        PluginIOS7Switch: PluginIOS7Switch
    });

    // jquery plugin
    $.fn.themePluginIOS7Switch = function (opts) {
        return this.each(function () {
            var $this = $(this);
            if ($this.data(instanceName)) {
                return $this.data(instanceName);
            } else {
                return new PluginIOS7Switch($this);
            }
        });
    }

}).apply(this, [window.theme, jQuery]);

function scrollToAnchor(tag) {
    var Tag = $(tag);
    $('html,body').animate({scrollTop: Tag.offset().top}, 'slow');
}

$(document).ready(function () {
    $('.req-email').on('invalid', function () {
        $(this).get(0).setCustomValidity("Email Error");
    })
})

$(document).ready(function () {
    $('.req-field').on('invalid', function () {
        $(this).get(0).setCustomValidity("Empty Field");
    })
})

$(document).ready(function () {
    $(document).on('click', '.down-flesh', function () {
        $('html, body').animate({
            scrollTop: $('#anchor-animate').offset().top - 60
        }, 1000);
    });
});

$(document).ready(function () {
    $('.container-bullet li').on('click', function () {
        $("video").each(function () {
            this.pause()
        });
        $('.container-bullet li').removeClass('active');
        $(this).addClass('active');
        var targertId = '#' + $(this).attr('data-target');
        $('.parts-container-slide').fadeOut(0);
        $(targertId).fadeIn(1000);
    })
});

$(document).ready(function () {
    setInterval(function () {
        var nextli = $('.container-bullet li.active').next('li');
        if (nextli.length > 0) {
            nextli.click();
        } else {
            $('.container-bullet li').first().click();
        }
    }, sliderTimer)
});

$(function () {
    $('.link').on('click', function () {
        $(this).next('.submenu').slideToggle();
        $(this).parent('li').toggleClass('open');
    });
});

$(document).ready(function () {
    var inP = $('.input-field');

    inP.on('blur', function () {
        if (!this.value) {
            $(this).parent('.f_row').removeClass('focus');
        } else {
            $(this).parent('.f_row').addClass('focus');
        }
    }).on('focus', function () {
        $(this).parent('.f_row').addClass('focus');
        $('.btn').removeClass('active');
        $('.f_row').removeClass('shake');
    });


    $('.resetTag').on('click', function (e) {
        e.preventDefault();
        $('.formBox').addClass('level-forget').removeClass('level-reg');
    });

    $('.back').on('click', function (e) {
        e.preventDefault();
        $('.formBox').removeClass('level-forget').addClass('level-login');
    });

    $('.regTag').on('click', function (e) {
        e.preventDefault();
        $('.formBox').removeClass('level-reg-revers');
        $('.formBox').toggleClass('level-login').toggleClass('level-reg');
        if (!$('.formBox').hasClass('level-reg')) {
            $('.formBox').addClass('level-reg-revers');
        }
    });

});

$(function () {
    $('.input-suggestion-btn').on('click', function () {
        var id = $(this).attr('data-id');
        var input = $('#input-suggestion_' + id).val();
        if (input == '') {
            $.notify({
                message: 'Please Enter Valid Search Query'
            }, {
                type: 'danger',
                allow_dismiss: false,
                z_index: '99999999',
                placement: {
                    from: "bottom",
                    align: "right"
                },
                position: 'fixed'
            });
        } else {
            window.location = '/request/suggestion/' + id + '/' + input;
        }
    })
})

$(function () {
    $(".hover").on('mouseleave',
        function () {
            $(this).removeClass("hover");
        }
    );
});

$(function () {
    $('.accordion-off ul li h2').on('click', function () {
        var listSort = $(this).parent().find('input.toggleAcc');
        if (listSort.attr('checked')) {
            listSort.removeAttr('checked');
        } else {
            listSort.attr('checked', 'checked');
        }
    })
})

function validate(evt) {
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode(key);
    var regex = /[0-9]|\./;
    if (!regex.test(key)) {
        theEvent.returnValue = false;
        if (theEvent.preventDefault) theEvent.preventDefault();
    }
}

$(function () {
    $(".validinput").on('keypress', function (event) {
        var ew = event.which;
        if (ew == 8)
            return true;
        if (ew == 32)
            return false;
        if (48 <= ew && ew <= 57)
            return true;
        if (65 <= ew && ew <= 90)
            return true;
        if (97 <= ew && ew <= 122)
            return true;
        return false;
    });
});

$(function () {
    jQuery('img.svg').each(function () {
        var $img = jQuery(this);
        var imgID = $img.attr('id');
        var imgClass = $img.attr('class');
        var imgURL = $img.attr('src');

        jQuery.get(imgURL, function (data) {
            // Get the SVG tag, ignore the rest
            var $svg = jQuery(data).find('svg');

            // Add replaced image's ID to the new SVG
            if (typeof imgID !== 'undefined') {
                $svg = $svg.attr('id', imgID);
            }
            // Add replaced image's classes to the new SVG
            if (typeof imgClass !== 'undefined') {
                $svg = $svg.attr('class', imgClass + ' replaced-svg');
            }

            // Remove any invalid XML tags as per http://validator.w3.org
            $svg = $svg.removeAttr('xmlns:a');

            // Replace image with new SVG
            $img.replaceWith($svg);

        }, 'xml');

    });
});

/* Form Validation */
$('input.validate').on('invalid', function (event) {
    $(this).get(0).setCustomValidity($(this).attr('valid-title'));
});
$('input.validate').on('input', function (event) {
    $(this).get(0).setCustomValidity('');
});

/* Toggle Menu */
$('.header-login-in-button').on('click', function (event) {
    event.preventDefault();
    $('.user-overlap').fadeToggle(500);
});

if (preloader == 1) {
    /* Page Loader */
    $('body').oLoader({
        image: '/bin/admin/files/loader.gif',
        wholeWindow: true,
        zIndex: 9999999,
        //effect:'slide',
        style: 0,
        modal: true,
        hideAfter: 2500,
        complete: function () {
            var scrollTo = $('#scrollId');
            if (scrollTo.length) {
                $('html, body').animate({
                    scrollTop: $('#scrollId').offset().top
                }, 1000);
            }
        }
    });
}

/* Owl Carousel */
$(document).ready(function () {
    $(".owl-carousel").owlCarousel({
        items: 4,
        navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'],
        navClass: ['nav-right', 'nav-left'],
        responsive: {
            0: {
                items: 1,
                nav: true,
                dots: false
            },
            480: {
                items: 1,
                nav: true,
                dots: false
            },
            762: {
                items: 2,
                nav: true,
                dots: false
            },
            992: {
                items: 4,
                nav: true,
                dots: false
            }
        }
    });
});

/* Search Box Optional Effect */
$('document').ready(function () {
    $('.search-box input[type="text"]').focus(function () {
        $('.search-box').css('border-color', '#FFAB00');
    });
    $('.search-box input[type="text"]').blur(function () {
        $('.search-box').css('border-color', '#E0E0E0');
    });
});

/* Easy AutoComplete */
var options = {
    url: function (phrase) {
        return "/jsonsearch/?q=" + phrase;
    },
    getValue: "title",

    template: {
        type: "description",
        fields: {
            description: "code"
        }
    },
    list: {
        showAnimation: {
            type: "fade",
            time: 400,
            callback: function () {
            }
        },

        hideAnimation: {
            type: "slide",
            time: 400,
            callback: function () {
            }
        }
    }
};
$(".provider-json").easyAutocomplete(options);
