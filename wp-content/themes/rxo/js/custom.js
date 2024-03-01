function showSearchContainer() {
    const searchContainer = document.getElementById("search-form-container");
    searchContainer.classList.add("show");
    const inputEle = document.getElementById("search-input");
    inputEle.focus();
}

function hideSearchContainer() {
    const searchContainer = document.getElementById("search-form-container");
    searchContainer.classList.remove("show");

    document.getElementById('search-input').value='';
    document.getElementById("search-input-clear-btn").classList.add("d-none");
}

function typeSearchContainer() {
    let headertext = document.getElementById("search-input").value;
    if(headertext!='') {
        document.getElementById("search-input-clear-btn").classList.remove("d-none");
    } else {
        document.getElementById("search-input-clear-btn").classList.add("d-none");
    }
}

// Search form: when a word gets typed, show the close icon - Search page
function searchTypeFunction() {
    let text = document.getElementById("search-page-input").value;
    if(text!='') {
        document.getElementById("search-page-clear-btn").classList.remove("d-none");
    } else {
        document.getElementById("search-page-clear-btn").classList.add("d-none");
    }
}

// Search form: When clicking the close button, clear the search input - Search page
function searchClearFunction() {
    document.getElementById('search-page-input').value='';
    document.getElementById("search-page-clear-btn").classList.add("d-none");
}


// Function to prevent dropdown from closing
function preventDropdownClose() {
    var $navbar = $("#navbarMenu");
    var $dropdown = $navbar.find(".dropdown");
    var $menu_header_secondary = $('#menu-header-secondary');

    // Remove existing click event handlers
    $dropdown.off("click");

    // Prevent the dropdown from closing when clicking inside it
    $dropdown.on("click", function (e) {
        e.stopPropagation();
    });

    

    $(document).on("click", function (e) {
        if (!$navbar.is(e.target) && $navbar.has(e.target).length === 0 && !$(".navbar-toggler").is(e.target) && $(".navbar-toggler").has(e.target).length === 0) {
            // If the clicked element is not the dropdown or a descendant of it
            $navbar.removeClass("show");

            if ($('#navbarMenu').hasClass('show')) {
                $(".navbar-toggler").removeClass("collapsed");
            } else {
                $(".navbar-toggler").addClass("collapsed");
            }
        }

        if (!$navbar.is(e.target) && $navbar.has(e.target).length === 0 && !$(".mobile-search-icon").is(e.target)) {
                $navbar.removeClass("main");
                $("#search-form-container").removeClass("main");
                $("#search-form-container").removeClass("show");
        }

        if (!$navbar.is(e.target) && $navbar.has(e.target).length === 0 && !$(".menu-search button").is(e.target)) {
            $("#search-form-container").removeClass("show");
    }

        if (!$menu_header_secondary.is(e.target) && $menu_header_secondary.has(e.target).length === 0 && !$(".trp-language-switcher-container.dropdown").is(e.target) && $(".trp-language-switcher-container.dropdown").has(e.target).length === 0) {
            //$('.trp-language-switcher-container ul.dropdown-menu').hide();
            $('.trp-language-switcher-container.dropdown').find('a.dropdown-toggle').removeClass('show');
            $('.trp-language-switcher-container ul.dropdown-menu').removeClass('show');
        }
    });
}



// Function to check the window width and call preventDropdownClose
function checkAndPreventDropdownClose() {
    if (window.innerWidth >= 1440) {
        preventDropdownClose();
    }
    if (window.innerWidth < 1440) {
        preventDropdownClose();
    }
}

// Call the function on window resize
$(window).on('resize', function () {
    checkAndPreventDropdownClose();

});

// Call the function on document load
$(document).ready(function () {
    checkAndPreventDropdownClose();

    /* End Avoid dropdown close on clicking inside */
    $('#search-input, #search-page-input, .wpforms-field-container input, .wpforms-field-container textarea').on('keypress', function(e) {
        if (e.which === 32 && !this.value.length)
        e.preventDefault();
    });

    $('#search-input , #search-page-input').bind('keyup change input paste',function(e){
        var $this = $(this);
        var val = $this.val();
        var valLength = val.length;
        var maxCount = '255';
        if(valLength>maxCount){
            $this.val($this.val().substring(0,maxCount));
            e.preventDefault(); // prevent the default submission
            alert("Your search keywords exceeds the limit of 255 chars");
            $this.val('');
            $this.focus();
        }
    });

    // Search icon - toggle option to show only the Search form for LG, MD and SM.
    $(".mobile-search-icon").on("click", function() {
        $("#navbarMenu, div[data-target=" + $(this).attr("data-search") + "]").toggleClass("main");
		$("#navbarMenu").removeClass("show");
        $(".navbar-toggler").addClass("collapsed");
		$(".menu-header-primary-container").hide();
        $(".dropdown-divider").hide();
        $("#topbar-navigation").hide();
    });

	$(".navbar-toggler").on("click", function() {
		$("#navbarMenu, div[data-target=" + $(this).attr("data-search") + "]").removeClass("main");
		$("#search-form-container").removeClass("main");
		if($('#navbarMenu').hasClass('show'))
		{
		$(".menu-header-primary-container").hide();
		} else {
		$(".menu-header-primary-container").show();
		}
		$(".dropdown-divider").show();
        $("#topbar-navigation").show();
	});

}); // End of document.ready()

/* Mega Menu */

$(document).ready(function(){

    $('span.megamenu-btnback, .menu-ship-with-rxo').hide();
    $('span.megamenu-btnback a').hide();

    $('.megamenu').on('show.bs.dropdown', function () {
        $(this).children('ul').addClass('row d-xxl-grid d-xl-grid d-lg-flex d-md-flex d-sm-flex');
    });
    $('.megamenu').on('hide.bs.dropdown', function () {
        $(this).children('ul').removeClass('row d-xxl-grid d-xl-grid d-lg-flex d-md-flex d-sm-flex show');
    });
    $('.rxo-sub-menu-heading').each(function(){
        $(this).children('a').css('cursor', 'default').css('text-decoration', 'none');
        $(this).children('a').removeAttr("href");
    });

});

function resizeXLMenu(){
    $('.dropdown').on('show.bs.dropdown', function () {
        $(this).show();
        $(this).siblings().show();
        $(this).siblings().find('ul').removeClass('show');
        $(this).siblings().find('ul').removeClass('row d-xxl-grid d-xl-grid d-lg-flex d-md-flex d-sm-flex');
        $('#topbar-navigation, .dropdown-divider').show();

        $(this).find('a.dropdown-toggle').attr('style','display: block !important');
        $(this).find('span.megamenu-btnback, .menu-ship-with-rxo').attr('style','display: none !important');
        $(this).find('span.megamenu-btnback a').attr('style','display: none !important');
        $(this).find('.rxo-sub-menu-heading a').attr('style','display: block !important');
        $(this).find('.sub').attr('style','display: block !important');
        $(this).find('.rxo-sub-menu-heading').find('ul.sub-menu').attr('style','display: block !important');
        $('.megamenu ul li').children('a').attr('style','display: inline !important');
        $(this).find('ul li a').removeAttr('style','display: inline !important');
    });
    $('.dropdown').on('hide.bs.dropdown', function () {
        $(this).show();
        $(this).siblings().show();
        $('#topbar-navigation, .dropdown-divider').show();
        $(this).find('a.dropdown-toggle').attr('style','display: block !important');
        $(this).find('span.megamenu-btnback, .menu-ship-with-rxo').attr('style','display: none !important');
        $(this).find('span.megamenu-btnback a').attr('style','display: none !important');
        $(this).find('.rxo-sub-menu-heading a').attr('style','display: none !important');
        $(this).find('.sub').attr('style','display: none !important');
        $('.megamenu ul li').children('a').attr('style','display: none !important');
    });

}
function resizeMenu() {
   $('.dropdown').on('show.bs.dropdown', function () {
        // Responsive - Show Mega menu on click and other all its siblings
        $(this).show();
        $(this).siblings().hide();
        $('#topbar-navigation, .dropdown-divider').hide();

        $(this).find('a.dropdown-toggle').attr('style','display: none !important');
        $(this).find('span.megamenu-btnback').attr('style','display: block !important');
        $(this).find('span.megamenu-btnback a').attr('style','display: block !important');
        $(this).find('.menu-ship-with-rxo').attr('style','display:  inline-block !important;');
        //$(this).find('.menu-ship-with-rxo a').attr('style','display: inline-block !important');
        $(this).find('.rxo-sub-menu-heading > a').attr('style','display: block !important');
        $(this).find('.rxo-sub-menu-heading').find('ul.sub-menu').attr('style','display: none !important');
        $(this).find('.rxo-sub-menu-heading').find('ul.sub-menu a').removeAttr('style','display: block !important');
        $(this).find('.sub').attr('style','display: block !important');
        $(this).find('ul li a').attr('style','display: inline !important');
        $('.megamenu').addClass('mb-0');
    });

    $('.dropdown').on('hide.bs.dropdown', function () {
        $(this).show();
        $(this).siblings().show();
        $('#topbar-navigation, .dropdown-divider').show();
        $(this).find('a.dropdown-toggle').attr('style','display: block !important');
        $(this).find('span.megamenu-btnback, .menu-ship-with-rxo').attr('style','display: none !important');
        $(this).find('span.megamenu-btnback a').attr('style','display: none !important');
        $(this).find('.rxo-sub-menu-heading a').attr('style','display: none !important');
        $(this).find('.rxo-sub-menu-heading').find('ul.sub-menu a').removeAttr('style','display: block !important');
        $(this).find('.sub').attr('style','display: none !important');
        $(this).find('ul li a').attr('style','display: none !important');
        $('.megamenu').removeClass('mb-0');
        $('.megamenu').children('ul').removeClass('row d-xxl-grid d-xl-grid d-lg-flex d-md-flex d-sm-flex show');
    });
}

// Run the script on page load
$(document).ready(function() {

    function toggleDropdownBasedOnWidth() {
        if (window.innerWidth < 1440) {
            resizeMenu();

            $('.rxo-sub-menu-heading').find('ul.sub-menu').attr('style','display: none !important');
            $('.dropdown').find('.sub').attr('style','display: none !important');
            $('#navbarMenu .dropdown li').find('a').attr('style','display: inline !important');
            $('#navbarMenu .dropdown ul li').find('a').attr('style','display: inline !important');
            $('.dropdown').find('.rxo-sub-menu-heading a').attr('style','display: none !important');
            $('.dropdown').find('.rxo-sub-menu-heading').find('ul.sub-menu').attr('style','display: none !important');
            $('.dropdown').find('.rxo-sub-menu-heading.sub-menu').find('a').removeAttr('style','display: block !important');
            $('.dropdown').find('.sub a').removeAttr('style','display: block !important');
            $('span.megamenu-btnback, .menu-ship-with-rxo').attr('style','display: none !important');
            $('span.megamenu-btnback a').attr('style','display: none !important');
            $('.megamenu').removeClass('mb-0');
            $('.megamenu').children('ul').removeClass('row d-xxl-grid d-xl-grid d-lg-flex d-md-flex d-sm-flex show');
            $('ul.dropdown-menu').removeClass('show');
            $('#topbar-navigation, .dropdown-divider').show();
			$('#topbar-navigation, .dropdown-divider').siblings().show();
			$('#menu-header-primary li,#menu-header-primary li a').show();

        } else if (window.innerWidth >= 1440) {
            resizeXLMenu();
            $('.dropdown').show();
            $('.dropdown').siblings().show();
            $('#topbar-navigation, .dropdown-divider').show();
            $('.dropdown').find('.rxo-sub-menu-heading a').attr('style','display: block !important');
            $('span.megamenu-btnback, .menu-ship-with-rxo').attr('style','display: none !important');
            $('span.megamenu-btnback a').attr('style','display: none !important');
            $('.dropdown').find('.sub').attr('style','display: block !important');
            $('.dropdown').find('.rxo-sub-menu-heading').find('ul.sub-menu').attr('style','display: block !important');
            $('.rxo-sub-menu-heading').find('ul.sub-menu').attr('style','display: block !important');
            $('.megamenu ul li').children('a').attr('style','display: inline !important');
            $('ul.dropdown-menu li').children('a').attr('style','display: block !important');
        }
    }

    toggleDropdownBasedOnWidth();

    var windowWidth = window.innerWidth;

    // Run the script on window resize
    $(window).on('resize', function(){

        if(windowWidth != window.innerWidth) {
            windowWidth = window.innerWidth;
            toggleDropdownBasedOnWidth();
        }

       // var win = $(this); //this = window
        if (window.innerWidth >= 1440) {
            $('.dropdown').find('a.dropdown-toggle').attr('style','display: block !important');
        }
    });

    $("li.rxo-sub-menu-heading > a").click(function(event) {
        if(window.innerWidth < 1440){
            event.stopPropagation();
            event.preventDefault();
            if($(this).next('ul.sub-menu').is(':hidden')) {
                $(this).next('ul.sub-menu').attr('style','display: block !important');
            } else {
                $(this).next('ul.sub-menu').attr('style','display: none !important');
            }
        }
    });

    $("span.megamenu-btnback > a").click(function(event) {

        // Responsive - Show Mega menu on click and other all its siblings
        $(this).parent().parent().show();
        $(this).parent().parent().siblings().show();
        $(this).parent().next().removeClass('show');
        $('#topbar-navigation, .dropdown-divider').show();

        $('.dropdown').find('a.dropdown-toggle').attr('style','display: inline !important');
        $('.dropdown').find('span.megamenu-btnback, .menu-ship-with-rxo').attr('style','display: none !important');
        $('.dropdown').find('span.megamenu-btnback a').attr('style','display: none !important');
        $('.dropdown').find('.rxo-sub-menu-heading a').attr('style','display: none !important');
        $('.dropdown').find('.sub').attr('style','display: none !important');

        $('.megamenu').removeClass('mb-0');
        $('.megamenu').children('a').removeClass('show');
        $('.megamenu').children('ul').removeClass('row d-xxl-grid d-xl-grid d-lg-flex d-md-flex d-sm-flex show');
    });

    // Remove empty p tags if added by WYSIWIG editor in RXO blocks
    $('.container p:empty').remove();

    //Added code for comparing the dates where delivery date must be greater than or equal to pickup date
    $('.rxo-delivery-date input').on('change', function() {
        var pickDate = new Date($('.rxo-pickup-date input').val());
        var deliverDate = new Date($('.rxo-delivery-date input').val());
        if(deliverDate < pickDate) {
            $('.rxo-delivery-date input').val('');
            alert('Delivery date must be greater than or equal to pick up date');
        }
    });

    $('.rxo-pickup-date input').on('change', function() {
        var pickDate = new Date($('.rxo-pickup-date input').val());
        var deliverDate = new Date($('.rxo-delivery-date input').val());
        if(pickDate > deliverDate) {
            $('.rxo-pickup-date input').val('');
            alert('Pick-up date cannot be greater than delivery date');
        }
    });

    $('.wpforms-form').submit(function() {
        var pickDate = new Date($('.rxo-pickup-date input').val());
        var deliverDate = new Date($('.rxo-delivery-date input').val());
        if(pickDate > deliverDate){
            $('.rxo-delivery-date input').val('');
            alert('Delivery date must be greater than or equal to pick up date');
        }
    });

    // Prevent the blank space characters in the begining after enters a text
    $('.wpforms-field-container input, .wpforms-field-container textarea').keydown(function(event){
        if(window.event.which === 32 && this.selectionStart === 0 && window.event.code === "Space"){
            window.event.preventDefault();
        }
    });

    $('.wpforms-field-container input[type="email"]').keydown(function(event) {
        if (event.key === ' ') {
            return false;
        }
    });

    // Prevent whiteapces as values in the WPform input fields
    // User can input a character, add trailing spaces, and then delete the initial character. So form gets submitted with blank space - Issue is fixed.
    $('.wpforms-field-container input, .wpforms-field-container textarea').on('change',function(){
        var inputVal = $.trim($(this).val().replace(/\s+/g, ' '));
        $(this).val(inputVal);
    });

    $('.rxo-wpf-char-max input').bind('keyup change input paste', function(e){
        var $this = $(this);
        var maxLength = '160';
        var charLength = $(this).val().length;
        if(charLength > maxLength){
            $this.val($this.val().substring(0,maxLength));
            e.preventDefault(); // prevent the default submission
        }else{
            $this.next(".rxo-custom-validate").remove();
        }
    });

    /*$('.rxo-address-formatting .wpforms-field-row:nth-of-type(1) input').bind('change input paste', function(e){
        var $this = $(this);
        var maxLength = '256';
        var minLength = '3';
        var charLength = $(this).val().length;
        if(charLength > maxLength){
            $this.val($this.val().substring(0,maxLength));
            e.preventDefault(); // prevent the default submission
            alert('Your keywords exceeds the limit of '+maxLength+' chars');
        }
        // else if(($this.val() !== '' || $this.val() !== null) && charLength < minLength){
        //     e.preventDefault(); // prevent the default submission
        //     alert('Your keyword short, minimum '+minLength+' chars required');
        // }
        else{
            $('.wpforms-container label.wpforms-error').text('');
        }
    });*/
});


jQuery(document).ready(function() {
    $(".rxo-form-with-address").bind('click', function(){
        if($('.wpforms-field-address-state').val() == null) {
            $('.wpforms-field-address-postal').parent().addClass('extra-spacing');
        } else {
            $('.wpforms-field-address-postal').parent().removeClass('extra-spacing');
        }
    });

    $(".wpforms-field-address-state").on("change", function() {
        if($('.wpforms-field-address-state').val() == null) {
            $('.wpforms-field-address-postal').parent().removeClass('extra-spacing10');
        } else {
            $('.wpforms-field-address-postal').parent().addClass('extra-spacing10');
        }
    });

    $(window).click(function() {
        if($(".wpforms-field-address-state").val() !== null) {
            $('.wpforms-field-address-state').removeClass('wpforms-error');
            $('.wpforms-field-address-state').addClass('wpforms-valid');
            $('.wpforms-field-address-state').siblings('label.wpforms-error').css('display','none');
            $('.wpforms-field-address-postal').parent().removeClass('extra-spacing');
        }
    });
});

jQuery(document).ready(function() {

    $(".rxo-form-with-address").bind('click', function(){
        if($('.wpforms-field-address-state').val() == null && $('.wpforms-field-address-postal').val() == '') {
            $('.wpforms-field-address-postal').parent().addClass('extra-spacing');
			$('.wpforms-field-address-postal').parent().removeClass('extra-spacing-update');
		} else if($('.wpforms-field-address-state').val() != null && $('.wpforms-field-address-postal').val() != '') {

        } else {
            $('.wpforms-field-address-postal').parent().removeClass('extra-spacing');
        }
    });

    $(window).click(function() {
        if($(".wpforms-field-address-state").val() !== null) {
            $('.wpforms-field-address-state').removeClass('wpforms-error');
            $('.wpforms-field-address-state').addClass('wpforms-valid');
            $('.wpforms-field-address-state').siblings('label.wpforms-error').css('display','none');
            $('.wpforms-field-address-postal').parent().removeClass('extra-spacing');
        }
    });

	$(".wpforms-field-address-postal, .wpforms-field-address-state").bind('keyup change', function(){
		var $this = $(this);
		 console.log('$this.val().replace(/[^0-9\.]+/g, "").length',$this.val().replace(/[^0-9\.]+/g, "").length);
		setTimeout(function(){
		if($this.val().replace(/[^0-9\.]+/g, "").length==5 || $this.val().replace(/[^0-9\.]+/g, "").length==9) {
			if($('.wpforms-field-address-state').val() == null && $this.hasClass('wpforms-valid')) {
				if($this.parent().hasClass('extra-spacing')) {
					$this.parent().removeClass('extra-spacing');
					$this.parent().addClass('extra-spacing-update');
				}
			} else if($('.wpforms-field-address-state').val() != null && $this.hasClass('wpforms-valid')) {
				if($this.parent().hasClass('extra-spacing')) {
					$this.parent().removeClass('extra-spacing');
					$this.parent().addClass('extra-spacing-update');
				} else {
					$this.parent().addClass('wpforms-first-update');
					$this.parent().removeClass('extra-spacing-update');
				}
			}

		} else if($this.val().replace(/[^0-9\.]+/g, "").length>0 || $this.val().replace(/[^0-9\.]+/g, "").length<9) {
            if($this.parent().hasClass('extra-spacing-update')) {
                $this.parent().removeClass('extra-spacing-update');
                $this.parent().addClass('extra-spacing');
            }
		} else if($this.val().replace(/[^0-9\.]+/g, "").length==0) {
			$this.parent().removeClass('wpforms-first-update');
			$this.parent().removeClass('extra-spacing-update');
		}
		},2000);
    });
});

function resizeTranslateMenu(){
    $('.trp-language-switcher-container.dropdown').on('show.bs.dropdown', function () {
        $('.dropdown-divider').attr('style', 'display: block !important');
        $('#topbar-navigation').attr('style', 'display: block !important');
        $(this).find('ul.dropdown-menu').attr('style', 'display: block !important');
        $(this).find('a.dropdown-toggle').attr('style', 'display: block !important');
    });

    $('.trp-language-switcher-container.dropdown').on('hide.bs.dropdown', function () {
        $(this).find('ul.dropdown-menu').attr('style', 'display: none !important');
    });
}

function resizeXLTranslateMenu(){
    $('.trp-language-switcher-container.dropdown').on('show.bs.dropdown', function () {
        $(this).find('ul.dropdown-menu').attr('style', 'display: block !important');
    });

    $('.trp-language-switcher-container.dropdown').on('hide.bs.dropdown', function () {
        $(this).find('ul.dropdown-menu').attr('style', 'display: none !important');
        $(this).find('a.dropdown-toggle').removeClass('show');
        $(this).find('ul.dropdown-menu').removeClass('show');
    });
}

$(document).ready(function(){
    
    function toggleTranslateDropdownBasedOnWidth() {
        if (window.innerWidth <= 1440) {
            resizeTranslateMenu();
            $('.dropdown-divider').attr('style', 'display: block !important');
            $('#topbar-navigation').attr('style', 'display: block !important');
        } else if (window.innerWidth > 1440) {
            resizeXLTranslateMenu();
            
        }
    }

    toggleTranslateDropdownBasedOnWidth();

    var windowInnerWidth = window.innerWidth;

    // Run the script on window resize
    $(window).on('resize', function(){

        if(windowInnerWidth != window.innerWidth) {
            windowInnerWidth = window.innerWidth;
            toggleTranslateDropdownBasedOnWidth();
        }

       // var win = $(this); //this = window
        if (windowInnerWidth > 1440) {
            $('.trp-language-switcher-container.dropdown').find('a.dropdown-toggle').attr('style','display: block !important');
            $('.trp-language-switcher-container.dropdown').find('ul.dropdown-menu').attr('style', 'display: none !important');
            $('.trp-language-switcher-container.dropdown').find('a.dropdown-toggle').toggleClass('show');
            $('.trp-language-switcher-container ul.dropdown-menu').removeClass('show');
        }else{
            $('.trp-language-switcher-container.dropdown').find('a.dropdown-toggle').attr('style','display: block !important');
            $('.trp-language-switcher-container.dropdown').find('ul.dropdown-menu').attr('style', 'display: none !important');
            $('.trp-language-switcher-container.dropdown').find('a.dropdown-toggle').removeClass('show');
            $('.trp-language-switcher-container ul.dropdown-menu').removeClass('show');
        }
    });

    // Add a click event listener to the link
    $('.trp-language-switcher-container a.dropdown-item').on('click', function(e) {
        // Prevent the default behavior of the link
        e.preventDefault();

        // Get the URL from the href attribute
        var url = $(this).attr('href');

        // Redirect to the URL
        window.location.href = url;
    });

});

$(document).ready(function(){
    setTimeout(function() {
        $('.rxo-block-job-board-market-listings #success-message').hide();
    }, 3000);
    setTimeout(function() {
        $('.rxo-block-job-board-market-listings #delete-message').hide();
    }, 3000);
});