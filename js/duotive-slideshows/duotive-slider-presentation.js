/* ******************************** */
/*                                  */
/*         duotive Slideshow        */
/*                                  */
/*    Version: presentation v1.1    */
/*                                  */
/* ******************************** */

var dtSliderPresentation = new Class({
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
	
	start: function() {
		that.setupImages();
		that.setupGallery();

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
	
	setupGallery: function(){
		var galleryUl = $$('#slider-gallery ul');
		that.options.galleryUl = galleryUl[0];
		galleryLi = that.options.galleryUl.getChildren('li');
		galleryLiWidth = 161;
		if ( galleryLi.length < 6 ){
			galleryLiWidth =  parseInt(960 / galleryLi.length, 10) + 1;
			galleryLi.setStyle('width', galleryLiWidth);
		}
		galleryUlWidth = galleryLi.length * galleryLiWidth;
		that.options.galleryUl.setStyle('width', galleryUlWidth);
		that.options.galleryItems = galleryLi.length;
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
		
		function animateDescription(index, value){
			descriptionFx[index].cancel();
			descriptionFx[index].start('opacity', value);
		}
		
		if (that.options.description == true && that.options.descriptionAutoHide == true) {
			// adding effects to the slide descriptions
			var descriptions = $$('#slider-images-wrapper span.content');
			var descriptionFx = [];
			descriptions.each(function(item, index){
				descriptionFx[index] = new Fx.Tween(item, {
					duration: parseInt(that.options.transitionDuration / 3, 10),
					transition: Fx.Transitions.Linear
				});
			});
			
			// adding events to the description boxes
			descriptions.setStyle('opacity', 0);
			slides.each(function(item, index){
				item.addEvents({
					'mouseenter': function(){
						animateDescription(index, 1);
					},
					'mouseleave': function(){
						animateDescription(index, 0);
					}
				});
			});
		} // end if
		
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
			
		// gallery effects
		var galleryFx = new Fx.Tween(
			that.options.galleryUl, {
				duration: that.options.transitionDuration, 
				transition: Fx.Transitions.Linear,
				wait: true
			}
		); 
		function animateGallery(value){
			galleryFx.cancel();
			galleryFx.start('left', -value);
		}
		function activeItem(){
			galleryLi.set('class', '');
			galleryLi[counter].set('class', 'active');
			
		}
		var galleryAnchors = $$('#slider-gallery a');
		galleryAnchors.each(function(item, index){
			item.addEvents({
				'click': function(){
					$clear(play);
					counter = index;
					transition();
					periodical();
				}
			});
		});
		
		// setting up the scroll bar
		var sliderScrollDiv = $('slider-scroll');
		var scrollMaxRange = that.options.galleryItems - 6;
		var scrollCurrentStep = 0;
		if (scrollMaxRange > 0) {
			var scrollHandleWidth = parseInt(parseInt(sliderScrollDiv.getStyle('width'), 10) / (that.options.galleryItems - 5), 10);
			if (scrollHandleWidth < 28) { scrollHandleWidth = 28; }
			sliderScrollDiv.getElement('.knob').setStyle('width', scrollHandleWidth);
		} else {
			scrollMaxRange = 0;
		}
		var scrollHandleFx = new Fx.Tween(sliderScrollDiv.getElement('.knob'), {
			duration: 500,
			transition: Fx.Transitions.Expo.easeInOut,
			wait: true
		});
		
		var sliderScroll = new Slider(sliderScrollDiv, sliderScrollDiv.getElement('.knob'), {
				range: [0, scrollMaxRange],
				initialStep: 0,
				wheel: true,
				snap: true,
				onChange: function(value){
					scrollCurrentStep = value;
					if (scrollMaxRange != 0) {
						var galleryPosition = value * galleryLiWidth;
						if ( galleryPosition > galleryUlWidth - 960 ) { galleryPosition = galleryUlWidth - 961; }
						animateGallery(galleryPosition);	
					}

				},
				onTick: function(value){
					scrollHandleFx.cancel();
					scrollHandleFx.start('left', value);
				}
		});
		
		// adding scroll arrows events
		if (scrollMaxRange != 0) {
			var scrollArrowLeft = $('slider-scroll-left');
			scrollArrowLeft.addEvents({
				'click': function(){
					scrollCurrentStep--;
					if (scrollCurrentStep < 0) {
						scrollCurrentStep = 0;
					}
					sliderScroll.set(scrollCurrentStep);
				}
			});
			var scrollArrowRight = $('slider-scroll-right');
			scrollArrowRight.addEvents({
				'click': function(){
					scrollCurrentStep++;
					if (scrollCurrentStep > scrollMaxRange) {
						scrollCurrentStep = scrollMaxRange;
					}
					sliderScroll.set(scrollCurrentStep);
				}
			});
		}
		// main trigger function
		function transition() {
			activeItem();
			animateSlides(oldCounter, 0);
			animateSlides(counter, 1);
			animateTimer();
			sliderScroll.set(counter);
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
		
		// calling the main functions
		activeItem();
		transition();
		periodical();	
	}	
});