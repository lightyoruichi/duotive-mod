/* ************************** */
/*                            */
/*     duotive Slideshow      */
/*                            */
/*   Version: complex v1.1    */
/*                            */
/* ************************** */

var duotiveSlide = new Class({
	Implements: Chain,
	initialize: function(options){
		// setting up the options
		this.options = options;
		that = this;
		
		// checking if the slider container exists
		if (this.options.container != null) {
			this.start();
		}		
	},
	
	setupGallery: function() {	
		// setting up the gallery width
		if ($('slider-gallery') != null) {
			gallery = $('slider-gallery');			
			// calculating galleryUl's width
			var galleryThumbWidth = 100;
			var galleryThumbHeight = 50;
			that.options.galleryThumbWidth = galleryThumbWidth; 
			var galleryThumbMargin;
			if (that.options.description == true) {
				galleryThumbMargin = 10;
				that.options.galleryThumbMargin = galleryThumbMargin;
			} else {
				galleryThumbMargin = 15;
				that.options.galleryThumbMargin = galleryThumbMargin;
			}			
			galleryThumbs = that.options.galleryUl.getChildren('li');
			galleryThumbs.getLast().setStyle('margin-right', 0);			
			galleryUlWidth = (galleryThumbs.length * (galleryThumbWidth + galleryThumbMargin)) - galleryThumbMargin;
			that.options.galleryUlWidth = galleryUlWidth; 
			that.options.galleryUl.setStyle('width', galleryUlWidth);
			// gallery images preloader
			var galleryAnchors = $$('#slider-gallery li a');
			if (galleryAnchors[0] != null) {
				galleryAnchors.each(function(item, index){
					var child = item.getChildren('img');
					var asset = Asset.image(child.getProperty('src'), {
						onComplete: child.setStyle('display', 'block')
					});
				});
			}
			
		} // end if
	},
		
	start: function() {
		var description = $('slider-description');
		var descriptionUl = $$('#slider-description ul');
		that.options.descriptionUl = descriptionUl[0];
		var gallery = $('slider-gallery');
		var galleryUl = $$('#slider-gallery ul');		
		that.options.galleryUl = galleryUl[0];
		
		that.setupImages();
		if (that.options.gallery == true) {
			that.setupGallery();
		} else {
			description.setProperty('class', 'full');
		}
		
		if (that.options.description == false) {
			gallery.setProperty('class', 'full');
		}
	},
		
	setupImages: function(){
		slides = $$('#slider-images-wrapper a');
		slides.setStyle('opacity', 0);
		var images = $$('#slider-images-wrapper img');
		var imagesSrc = [];
		images.each(function(item, index){
			imagesSrc[index] = item.getProperty('src');
		});
		var imagesAsset = Asset.images(imagesSrc, {
		    onComplete: function(){
				slides.setStyle('display', 'block');
				$('slider-images-wrapper').setStyle('background-image', 'none');
				that.play();
			}
		});
	},
	
	play: function(){
		counter = 0;
		oldCounter = counter;
				
		// adding the slides' transition effect 
		var fx = [];
		slides.each(function(item, index){
			fx[index] = new Fx.Tween(item, {
				duration: that.options.transitionDuration,
				transition: Fx.Transitions.Linear
			});
		});
		function animateSlides(index, value){
			fx[index].cancel();
			fx[index].start('opacity', value);
		}
		
		// animating the slideshow description	
		if (that.options.description == true) {
			var descriptionLi = that.options.descriptionUl.getChildren('li');
			var descriptionLiHeight = 50;
			var descriptionLiMargin = 30;
			descriptionUlHeight = descriptionLi.length * (descriptionLiHeight + descriptionLiMargin);
			that.options.descriptionUl.setStyle('height', descriptionUlHeight);
			var descriptionUlPosition = 0;
			var descriptionFx = new Fx.Tween(that.options.descriptionUl, {
				duration: that.options.transitionDuration,
				transition: Fx.Transitions.Cubic.easeOut
			});
		} // end if
		function animateDescription() {
			descriptionUlPosition = -(counter * (descriptionLiHeight + descriptionLiMargin));
			descriptionFx.cancel();
			descriptionFx.start('top', descriptionUlPosition);
		}			
				
		// "the active thumbnail"
		if (that.options.gallery == true) {
			var thumbnails = $$('#slider-gallery a');
		} // end if
		function activeThumbnail(){
			thumbnails.setProperty('class', '');
			thumbnails[counter].setProperty('class', 'active');
		}

		// setting up the timer animation
		var timer = $('slider-progress-bar');
		var timerFx = new Fx.Tween(timer, {
			duration: that.options.transitionInterval,
			transition: Fx.Transitions.Linear
		});	
		function animateTimer(){
			timerFx.cancel();
			timer.setStyle('width', 0);
			timerFx.start('width', 960);	
		}

		// main trigger function
		function transition() {
			animateSlides(oldCounter, 0);
			animateSlides(counter, 1);
			animateTimer();
			if (that.options.description == true) { animateDescription(); }
			if (that.options.gallery == true) {
				galleryMove();
				activeThumbnail();
			}
			oldCounter = counter;
			counter++;
		}
		
		// slideshow loop		
		function periodical(){
			play = (function(){
				if (counter < slides.length) {
					transition();
				} else {
					counter = 0;
					transition();
				}
			}).periodical(that.options.transitionInterval);
		}
		
		// left/right controls
		if (that.options.arrowControls == true) {
			var controlLeft = $('slider-control-left');
			var controlRight = $('slider-control-right');
			controlRight.addEvents({
				'click': function(){
					$clear(play);
					if (counter < slides.length) {
						transition();					
					} else {
						counter = 0;
						transition();
					}
					periodical();				
				}
			});
			controlLeft.addEvents({
				'click': function(){
					$clear(play);
					counter--;
					counter--;
					if ( counter < 0 ) {
						counter = slides.length - 1;
					}
					transition();
					periodical();
				}
			});	
		} // end if
		
		// gallery events
		if (that.options.gallery == true) {
			var galleryThumbs = $$('#slider-gallery a');
			galleryThumbs.each(function(item, index){
				item.addEvents({
					'click': function(){
						$clear(play);
						counter = index;
						transition();
						periodical();
					}
				});
			});
			
			var galleryPos = 0;
			var galleryUlFx = new Fx.Tween(that.options.galleryUl, {
				duration: that.options.transitionDuration,
				transition: Fx.Transitions.Cubic.easeOut
			});
		} // end if
		function galleryMove() {
			var gallery = $('slider-gallery');
			var galleryWidth = parseInt(gallery.getStyle('width'), 10);	
			galleryPos = -(counter * (that.options.galleryThumbMargin + that.options.galleryThumbWidth));
			if (counter != 0) {
				galleryPos = galleryPos + that.options.galleryThumbMargin + that.options.galleryThumbWidth;
			} 
			if (galleryPos < -(that.options.galleryUlWidth - galleryWidth)) {
				galleryPos = -(that.options.galleryUlWidth - galleryWidth);
			}
			if (galleryPos > 0) {
				galleryPos = 0;
			}
			galleryUlFx.cancel();
			galleryUlFx.start('left', galleryPos);
		}
		
		// calling main functions
		if (that.options.gallery == true) { activeThumbnail(); }
		transition();
		periodical();
	}
});