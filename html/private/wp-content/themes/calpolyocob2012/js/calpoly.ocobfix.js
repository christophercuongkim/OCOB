$jq(document).ready(function () {
    var x; /* Applies tabindex to links in header area, main nav, and rotator  */
    /*Uncomment if search box is moved into header region.Then delete section marked belowvar tabindex1 = ["#header a", "#search form input#q", "#search form input#searchSubmit"];for (x=0; x < tabindex1.length; x++){$jq(tabindex1[x]).attr("tabindex", 1);}var tabindex2 = ["ul#cpUl li a"];for (x=0; x <tabindex2.length; x++){$jq(tabindex2[x]).attr("tabindex", 2);}*/
    /*Start delete*/
    $jq("#header a").attr("tabindex", 1);
    var tabindex2 = ["ul#cpUl li a", "#search form input#q", "#search form input#searchSubmit"];
    for (x = 0; x < tabindex2.length; x++) {
        $jq(tabindex2[x]).attr("tabindex", 2);
    } /*End delete*/
    $jq("#imageArrowRight, #imageArrowLeft").attr("tabindex", 3);
});
$jq(document).ready(function () { /* Inserts "Pause Rotating Stories" lin if rotator is present  */
    if ($jq('#heroContainer').length != 0) {
        $jq('<li><a href="javascript:;" id="topPause" tabindex="1">Pause Rotating Stories</a></li>').insertAfter('#accessibilityNav ul li:eq(0)');
        $jq("#imageScrollerWindow .heroBlock:first-child").addClass("heroBlockActive");
        $jq("#imageScrollerWindow .heroBlock:first-child .heroTextHolder").children().addClass("heroContentActive");
    } /* Blanks text in search query and email signup input boxes  */
    var searchPlaceholder = $jq('#q').val();
    var emailPlaceholder = $jq('#emailSignup').val();
    $jq('#q').focus(function () {
        if ($jq('#q').val() == searchPlaceholder) {
            $jq('#q').val('');
        }
        if ($jq('.largeNav').hasClass('largeNavActive')) {
            $jq('.largeNav').removeClass('largeNavActive');
            $jq('#cp').removeAttr('style');
            $jq('#cpUl li a').attr('tabindex', '2');
            $jq('.cpActive').removeClass('cpActive');
            $jq('#cpUl li a').attr('title', 'Expand Menu');
        }
    });
    $jq('#q').blur(function () {
        if ($jq('#q').val() == '') {
            $jq('#q').val(searchPlaceholder);
        }
    });
    $jq('#emailSignup, .emailSignup').focus(function () {
        if ($jq(this).val() == emailPlaceholder) {
            $jq(this).val('');
        }
    });
    $jq('#emailSignup, .emailSignup').blur(function () {
        if ($jq(this).val() == '') {
            $jq(this).val(emailPlaceholder);
        }
    });
}); /* A to Z index, quicklinks, maps dropdowns  */
$jq('#azindex a').not('#azindexdropdown li a').click(function () {
    if ($jq(this).siblings('ul').css('display') == 'none') {
        $jq('#azindexdropdown').addClass('azindexdropdownActive');
        $jq(this).addClass('azActive');
    } else {
        $jq('#azindexdropdown').removeClass('azindexdropdownActive');
        $jq(this).removeClass('azActive');
    }
});
$jq('#azindexdropdown li a').focus(function () {
    $jq('#azindexdropdown').addClass('azindexdropdownActive');
});
$jq('#azindex').hover(function () {
    $jq('#quicklinksdropdown').removeClass('quicklinksdropdownActive');
}, function () {
    if ($jq('#azindexdropdown').hasClass('azindexdropdownActive')) {
        $jq('a', this).not('#azindexdropdown li a').addClass('azActive');
    }
});
$jq('#quicklinks a').click(function () {
    if ($jq(this).siblings('ul').css('display') == 'none') {
        $jq('#quicklinksdropdown').addClass('quicklinksdropdownActive');
    } else {
        $jq('#quicklinksdropdown').removeClass('quicklinksdropdownActive');
    }
});
$jq('#quicklinks').hover(function () {
    $jq('#azindexdropdown').removeClass('azindexdropdownActive');
    $jq('#azindex a').removeClass('azActive');
}, function () {});
$jq('#quicklinks a, #utilityNav a').not('#azindexdropdown li a, #azindex a').focus(function () {
    if ($jq('#azindex ul').css('display') == 'block') {
        $jq('#azindex ul').removeClass('azindexdropdownActive');
        $jq('#azindex a').removeClass('azActive');
    }
});
$jq('#maps a, #azindex a').focus(function () {
    if ($jq('#quicklinks ul').css('display') == 'block') {
        $jq('#quicklinks ul').removeClass('quicklinksdropdownActive');
    }
});
/* Modified */
$jq(document).ready(function () { /* Big Menu dropdown + title and tabindex attributes  */
    $jq('#cpUl li a').not('#cpUl.cpStandardNav li a, .largeNav a,#cpUl li.noMenu a').attr({
        'href': 'javascript:;',
        'title': 'Expand Menu'
    });
});
$jq('#cpUl').not('#cpUl.cpStandardNav').children('li').children('a').click(function () {
    if (!$jq(this).siblings('.largeNav').hasClass('largeNavActive')) {
        $jq('.largeNav').removeClass('largeNavActive');
        $jq('.cpActive a:first').attr('title', 'Expand Menu');
        $jq('.cpActive').removeClass('cpActive');
        $jq(this).parent().addClass('cpActive');
        $jq(this).siblings('.largeNav').addClass('largeNavActive');
        $jq('#cp').css('border-bottom', '5px solid #7f9974');
        $jq(this).attr('title', 'Close Expanded Menu');
        var thisTab = $jq('.cpActive').index();
        $jq("#cpUl li a:gt(" + thisTab + ")").attr('tabindex', '2');
    } else {
        $jq(this).parent().removeClass('cpActive');
        $jq(this).siblings('.largeNav').removeClass('largeNavActive');
        $jq('#cp').removeAttr('style');
        $jq(this).attr('title', 'Expand Menu');
    }
});
$jq('*').focus(function () {
    if ($jq(this).closest('#cp').length == 0 || $jq(this).attr('id') == 'q') {
        $jq('.largeNav').removeClass('largeNavActive');
        $jq('#cp').removeAttr('style');
        $jq('.cpActive a:first').attr('title', 'Expand Menu');
        $jq('.cpActive').removeClass('cpActive');
    }
    if ($jq(this).closest('#azindex').length == 0) {
        $jq('#azindexdropdown').removeClass('azindexdropdownActive');
        $jq('.azActive').removeClass('azActive');
    }
    if ($jq(this).closest('#quicklinks').length == 0) {
        $jq('#quicklinksdropdown').removeClass('quicklinksdropdownActive');
    }
});
$jq('*').click(function () {
    if ($jq(this).closest('#cp').length == 0) {
        $jq('.largeNav').removeClass('largeNavActive');
        $jq('#cp').removeAttr('style');
        $jq('.cpActive a:first').attr('title', 'Expand Menu');
        $jq('.cpActive').removeClass('cpActive');
    }
    if ($jq(this).closest('#azindex').length == 0) {
        $jq('#azindexdropdown').removeClass('azindexdropdownActive');
        $jq('.azActive').removeClass('azActive');
    }
});
$jq('#cp').find('*').click(function (event) {
    event.stopPropagation();
});
$jq('#azindex').find('*').click(function (event) {
    event.stopPropagation();
});
$jq('.largeNavClose').click(function () {
    $jq('.largeNavActive').removeClass('largeNavActive');
    $jq('#cp').removeAttr('style');
    $jq('.cpActive a').eq(1).attr('title', 'Expand Menu');
    var activeTab = $jq('#cpUl').children('.cpActive');
    var indexNumber = $jq('#cpUl').children('li').index(activeTab) + 1;
    $jq('#cpUl').children('li').eq(indexNumber - 1).children('a:first').focus();
    $jq('.cpActive').removeClass('cpActive');
});
$jq('#cpUl li a').focus(function () {
    if ($jq(this).parent().hasClass('cpActive')) {
        $jq(this).attr('tabindex', '1');
        var thisTab = $jq('.cpActive').index() + 1;
        $jq('#cpUl li a:lt(' + thisTab + ')').not('.largeNav a').attr('tabindex', '1');
        $jq('#cpUl li a:gt(' + thisTab + ')').not('.largeNav a').attr('tabindex', '2');
    }
}); /* Hero - image & article rotator  */
$jq(document).ready(function () {
    var scrollCount = 1;
    var rightToggle = true;
    var leftToggle = true;
    var imageCount = $jq('#imageScrollerWindow').children().length;
    var nextImage = 2;
    var prevImage = imageCount;
    var newDate = '';
    var newTitle = '';
    var newContent = '';
    var newLinkText = '';
    var newLink = '';
    $jq('#heroTextVisible').addClass('heroTextVisibleOn');
    $jq('.heroTextHolder').addClass('heroTextHolderOff');
    $jq('.heroBlock:nth-child(1) .scrollerImage').addClass('scrollerImageCurrent');
    $jq('.heroBlock:nth-child(2) .scrollerImage').addClass('scrollerImageNext');
    $jq('.heroBlock:nth-child(' + prevImage + ') .scrollerImage').addClass('scrollerImagePrevious');
    $jq('.scrollerImage').not('.scrollerImageCurrent').css('left', '100%');
    $jq('#heroTextVisible .articleDate').html($jq('.heroBlockActive .heroTextHolder .articleDate').html());
    $jq('#heroTextVisible h2').html($jq('.heroBlockActive .heroTextHolder h2').html());
    $jq('#heroTextVisible p').html($jq('.heroBlockActive .heroTextHolder p').html());
    $jq('#heroTextVisible a').not('#readAllStories').html($jq('.heroBlockActive .heroTextHolder a').html());
    $jq('#heroTextVisible a').not('#readAllStories').attr('href', $jq('.heroBlockActive .heroTextHolder a').attr('href'));

    function scrollRight() {
        if (rightToggle == true) {
            nextImage = (scrollCount + 2) % imageCount;
            if (nextImage == 0) {
                nextImage = imageCount;
            }
            leftToggle = false;
            rightToggle = false;
            scrollCount++;
            scrollCount = scrollCount % imageCount;
            if (scrollCount == 0) {
                scrollCount = imageCount;
            }
            newDate = $jq('.heroBlock:nth-child(' + scrollCount + ') .heroTextHolder .articleDate').html();
            newTitle = $jq('.heroBlock:nth-child(' + scrollCount + ') .heroTextHolder h2').html();
            newContent = $jq('.heroBlock:nth-child(' + scrollCount + ') .heroTextHolder p').html();
            newLinkText = $jq('.heroBlock:nth-child(' + scrollCount + ') .heroTextHolder a').html();
            newLink = $jq('.heroBlock:nth-child(' + scrollCount + ') .heroTextHolder a').attr('href');
            $jq('#heroTextVisible').children().stop(true, true).fadeTo(500, 0, function () {
                $jq('.heroBlockActive').removeClass('heroBlockActive');
                $jq('.heroBlock:nth-child(' + scrollCount + ')').addClass('heroBlockActive');
                $jq('#heroTextVisible .articleDate').html(newDate);
                $jq('#heroTextVisible h2').html(newTitle);
                $jq('#heroTextVisible p').html(newContent);
                $jq('#heroTextVisible a').not('#readAllStories').html(newLinkText);
                $jq('#heroTextVisible a').not('#readAllStories').attr('href', newLink);
                $jq('#heroTextVisible').children().fadeTo(500, 1);
            });
            $jq('.scrollerImageCurrent').animate({
                left: '-100%'
            }, 1000, function () {
                $jq('.scrollerImagePrevious').not(this).removeClass('scrollerImagePrevious');
                $jq(this).removeClass('scrollerImageCurrent').addClass('scrollerImagePrevious');
            });
            $jq('.scrollerImageNext').css('left', '100%').animate({
                left: '0%'
            }, 1000, function () {
                $jq(this).removeClass('scrollerImageNext').addClass('scrollerImageCurrent');
                $jq('.heroBlock:nth-child(' + nextImage + ') .scrollerImage').addClass('scrollerImageNext');
                leftToggle = true;
                rightToggle = true;
            });
        } else {}
    }
    function scrollLeft() {
        if (leftToggle == true) {
            prevImage = (scrollCount - 2 + imageCount) % imageCount;
            if (prevImage == 0) {
                prevImage = imageCount;
            }
            leftToggle = false;
            rightToggle = false;
            scrollCount--;
            scrollCount = scrollCount % imageCount;
            if (scrollCount == 0) {
                scrollCount = imageCount;
            }
            newDate = $jq('.heroBlock:nth-child(' + scrollCount + ') .heroTextHolder .articleDate').html();
            newTitle = $jq('.heroBlock:nth-child(' + scrollCount + ') .heroTextHolder h2').html();
            newContent = $jq('.heroBlock:nth-child(' + scrollCount + ') .heroTextHolder p').html();
            newLinkText = $jq('.heroBlock:nth-child(' + scrollCount + ') .heroTextHolder a').html();
            newLink = $jq('.heroBlock:nth-child(' + scrollCount + ') .heroTextHolder a').attr('href');
            $jq('#heroTextVisible').children().stop(true, true).fadeTo(500, 0, function () {
                $jq('.heroBlockActive').removeClass('heroBlockActive');
                $jq('.heroBlock:nth-child(' + scrollCount + ')').addClass('heroBlockActive');
                $jq('#heroTextVisible .articleDate').html(newDate);
                $jq('#heroTextVisible h2').html(newTitle);
                $jq('#heroTextVisible p').html(newContent);
                $jq('#heroTextVisible a').not('#readAllStories').html(newLinkText);
                $jq('#heroTextVisible a').not('#readAllStories').attr('href', newLink);
                $jq('#heroTextVisible').children().fadeTo(500, 1);
            });
            $jq('.scrollerImageCurrent').animate({
                left: '100%'
            }, 1000, function () {
                $jq('.scrollerImageNext').not(this).removeClass('scrollerImageNext');
                $jq(this).removeClass('scrollerImageCurrent').addClass('scrollerImageNext');
            });
            $jq('.scrollerImagePrevious').css('left', '-100%').animate({
                left: '0%'
            }, 1000, function () {
                $jq(this).removeClass('scrollerImagePrevious').addClass('scrollerImageCurrent');;
                $jq('.heroBlock:nth-child(' + prevImage + ') .scrollerImage').addClass('scrollerImagePrevious');
                leftToggle = true;
                rightToggle = true;
            });
        } else {}
    } /* navigation - rotator big arrows and small nav  */
    $jq('#imageArrowRight').click(function () {
        scrollRight();
    });
    $jq('#imageArrowLeft').click(function () {
        scrollLeft();
    });
    $jq('#smallNext').click(function () {
        scrollRight();
    });
    $jq('#smallPrev').click(function () {
        scrollLeft();
    });
    var imageScrollerTimer = 0;
    imageScrollerTimer = setInterval(scrollRight, 9000);
    var pause = null;
    $jq('#imageScrollerContainer, #imageArrowRight, #imageArrowLeft').hover(function () {
        if (!pause) {
            clearInterval(imageScrollerTimer);
        }
    }, function () {
        if (!pause) {
            clearInterval(imageScrollerTimer);
            imageScrollerTimer = setInterval(scrollRight, 9000);
        }
    });
    $jq('#imageArrowRight, #imageArrowLeft, #smallPause, #smallNext, #smallPrev, #heroTextVisible a').focus(function () {
        if (!pause) {
            clearInterval(imageScrollerTimer);
        }
    });
    $jq('#imageArrowRight, #imageArrowLeft, #smallPause, #smallNext, #smallPrev, #heroTextVisible a').blur(function () {
        if (!pause) {
            clearInterval(imageScrollerTimer);
            imageScrollerTimer = setInterval(scrollRight, 9000);
        }
    });
    $jq('#smallPause, #topPause').click(function () {
        if (!pause) {
            clearInterval(imageScrollerTimer);
            pause = 1;
            $jq('#smallPause img').css('left', '-19px');
        } else {
            clearInterval(imageScrollerTimer);
            imageScrollerTimer = setInterval(scrollRight, 9000);
            pause = null;
            $jq('#smallPause img').css('left', '0px');
        }
    }); /* Majors/Collegs search feature  */
    $jq('#searchTab').click(function () {
        $jq('.majorTabActive').removeClass('majorTabActive');
        $jq(this).addClass('majorTabActive');
        $jq('.byCollege').removeClass('majorSearchActive');
        $jq('.plainSearch').addClass('majorSearchActive');
    });
    $jq('#byCollegeTab').click(function () {
        $jq('.majorTabActive').removeClass('majorTabActive');
        $jq(this).addClass('majorTabActive');
        $jq('.plainSearch').removeClass('majorSearchActive');
        $jq('.byCollege').addClass('majorSearchActive');
    });
});