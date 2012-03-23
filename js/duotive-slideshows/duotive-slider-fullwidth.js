/* ***************************** */
/*                               */
/*       duotive Slideshow       */
/*                               */
/*   Version: fullwidth v2.1   */
/*                               */
/* ***************************** */

var dtFullWidthSlider = new Class({
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
			galleryUl = $$('#slider-gallery ul');
			galleryUl = galleryUl[0];
			
			// calculating galleryUl's width
			galleryThumbWidth = 100;
			galleryThumbHeight = 50;
			galleryThumbMargin = 17;
			galleryThumbs = galleryUl.getChildren('li');
			galleryThumbs.getLast().setStyle('margin-right', 0);			
			galleryUlWidth = (galleryThumbs.length * (galleryThumbWidth + galleryThumbMargin)) - galleryThumbMargin;
			galleryUl.setStyle('width', galleryUlWidth);
			
			// gallery thumbnails preloader
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
		that.setupImages();
		if (that.options.gallery == true) {
			that.setupGallery();
		}
	},
		
	setupImages: function(){
		slides = $$('#slider-images-wrapper a');
		slides.setStyle('opacity', 0);
		var images = $$('#slider-images-wrapper img');
		var imagesSrc = [];
		images.each(function(item, index){
			imagesSrc[index] = item.getProperty('src');
			var bg = 'url(' + imagesSrc[index] + ')' + ' no-repeat center top';
			slides[index].setStyle('background', bg);
			item.dispose();
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
						
		// "the active thumbnail"
		if (that.options.gallery == true) {
			var thumbnails = $$('#slider-gallery a');
		} // end if
		function activeThumbnail(){
			thumbnails.setProperty('class', '');
			thumbnails[counter].setProperty('class', 'active');
		}
		
		// "the active content"
		if (that.options.contentBox == true) {
			var contentLi = $$('#contentbox ul li');
			var contentLiFx = [];
			contentLi.each(function(item, index){
				contentLiFx[index] = new Fx.Tween(item, {duration: 500});
			});
			contentLi.setStyle('opacity', 0);
		}		
		function activeContentBox() {				
			contentLiFx[oldCounter].cancel();
			contentLiFx[oldCounter].start('opacity', 0);	
			contentLiFx[counter].cancel();
			contentLiFx[counter].start('opacity', 1);
		}
		
		// title animation sequence
		function animateTitles() {	
			titles.each(function(item, index){
				switch(index) {
					case counter-2:
						titlesFx[counter - 2].cancel();
						titlesFx[counter - 2].start('.slideTitlesDefault');
						break;
					case counter-1:
						titlesFx[counter - 1].cancel();
						titlesFx[counter - 1].start('.slideTitlesNear');
						break;
					case counter:
						titlesFx[counter].cancel();
						titlesFx[counter].start('.slideTitlesActive');
						break;
					case counter+1:
						titlesFx[counter + 1].cancel();
						titlesFx[counter + 1].start('.slideTitlesNear');
						break;
					case counter+2:
						titlesFx[counter + 2].cancel();
						titlesFx[counter + 2].start('.slideTitlesDefault');
						break;
					default:
						titlesFx[index].cancel();
						titlesFx[index].start('.slideTitlesDefault');
						break;
				} // end switch
			});				
		}
		
		function animateTitlesUl() {
			titlesUlPos = counter * 20 - 40;
			titlesUlFx.cancel();
			titlesUlFx.start('top', -titlesUlPos);
		}
		
		function playButtonFunc() {
			if (playButton.getProperty('class') != 'pause') {
				$clear(play);
				playButton.set('class', 'pause');
			} else {
				$clear(play);
				playButton.set('class', '');
				periodical();
			}
		}
		
		
		// SETTING UP THE CONTENT TITLES
		// left/right controls
		
		function slidePlayNext(){
			$clear(play);
			if (counter < slides.length) {
				transition();					
			} else {
				counter = 0;
				transition();
			}
			periodical();	
		}
		
		function slidePlayPrev(){
			$clear(play);
			counter--;
			counter--;
			if ( counter < 0 ) {
				counter = slides.length - 1;
			}
			transition();
			periodical();	
		}
		
		if (that.options.slideTitles == true) {
			$('slider-text').setStyle('display', 'block');
						
			var titles = $$('#slider-text li a');
			var titlesFx =  [];
			
			// title click events
			titles.each(function(item, index){
				titlesFx[index] = new Fx.Morph(item, {duration: 400, wait:true});
				item.addEvents({
					'click':function(){
						$clear(play);
						counter = index;
						transition();
						periodical();						
					}
				});
			});			

			// titles scrolling effects
			var titlesUl = $$('#slider-text ul');
			titlesUl = titlesUl[0];
			titlesUlFx =  new Fx.Tween(titlesUl, {duration: that.options.transitionDuration, transition: Fx.Transitions.Cubic.easeOut});
			
			
			// title controls events
			playButton = $('slider-control-play');
			playButton.addEvents({
				'click': playButtonFunc
			});
			
			var titlesUpButton = $('slider-control-up');
			var titlesDownButton = $('slider-control-down');
			titlesUpButton.addEvents({'click':slidePlayPrev});
			titlesDownButton.addEvents({'click':slidePlayNext});
			
		} // end if
		
		// main trigger function
		function galleryMove() {
			var gallery = $('slider-gallery');
			var galleryWidth = parseInt(gallery.getStyle('width'), 10);
			galleryPos = -(counter * (galleryThumbMargin + galleryThumbWidth));
			if (counter != 0) {
				galleryPos = galleryPos + galleryThumbMargin + galleryThumbWidth;
			}
			if (galleryPos < -(galleryUlWidth - galleryWidth)) {
				galleryPos = -(galleryUlWidth - galleryWidth);
			}
			if (galleryPos > 0) {
				galleryPos = 0;
			}				
			galleryUlFx.cancel();
			galleryUlFx.start('left', galleryPos);
		}		
		
		function transition() {			
			animateSlides(oldCounter, 0);
			animateSlides(counter, 1);
			
			if (that.options.gallery == true) {
				galleryMove();
				activeThumbnail();
			}
			if (that.options.slideTitles == true) {
				animateTitles();
				animateTitlesUl();
				if (playButton.getProperty('class') == 'pause' )  {
					playButton.set('class', '');
				}
			}
			if (that.options.contentBox == true) { activeContentBox(); }
			
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
				
		if (that.options.arrowControls == true) {
			var controlLeft = $('slider-control-left');
			var controlRight = $('slider-control-right');
			controlRight.addEvents({'click': slidePlayNext});
			controlLeft.addEvents({'click': slidePlayPrev});	
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
			var galleryUlFx = new Fx.Tween(galleryUl, {
				duration: that.options.transitionDuration,
				transition: Fx.Transitions.Cubic.easeOut
			});
		} // end if
		
		function contentBoxAnim(value){
			sliderContentboxFx.cancel();
			sliderContentboxFx.start({
				'top':value
			});
		}
		
		if (that.options.contentBox == true) {
			
			// content events
			var sliderOverlay = $('slider-overlay');
			var sliderOverlayFx = new Fx.Morph(sliderOverlay, {duration: 350});
			var sliderContentbox = $('contentbox');
			var sliderContentboxFx = new Fx.Morph(sliderContentbox, {duration: 350, transition: Fx.Transitions.Cubic.easeOut});
			var sliderContentClose = $('contentbox-close');
			var sliderContentNext = $('contentbox-next');
			var sliderContentPrev = $('contentbox-prev');
						
			sliderContentNext.addEvents({
				'click': function(){
					slidePlayNext();
					$clear(play);
					if (that.options.slideTitles == true) {
						if (playButton.getProperty('class') != 'pause' )  {
							playButton.set('class', 'pause');
						}
					}	
				}
			});
			sliderContentPrev.addEvents({
				'click': function(){
					slidePlayPrev();
					$clear(play);
					if (that.options.slideTitles == true) {
						if (playButton.getProperty('class') != 'pause' )  {
							playButton.set('class', 'pause');
						}
					}										
				}
			});
			
			[sliderContentClose, sliderOverlay].each(function(item){
				item.addEvents({
					'click':function(){
						contentBoxAnim(-300);
						(function(){
							sliderOverlayFx.cancel();
							sliderOverlayFx.start({
								'height':0,
								'margin-top':0,
								'opacity':0
							});
							
							if (that.options.slideTitles == true) {
								if (playButton.getProperty('class') == 'pause' )  {
									playButton.set('class', '');
								}
							}
							$clear(play);
							periodical();
						}).delay(150, this);
					}
				});			
			});
			
			slides.each(function(item, index){
				item.addEvents({
					'click':function(link){
						link.stop();
						$clear(play);
						sliderOverlayFx.cancel();
						sliderOverlayFx.start({
							'height':502,
							'margin-top':-251,
							'opacity':1
						});
						
						if (that.options.slideTitles == true) {
							if (playButton.getProperty('class') != 'pause' )  {
								playButton.set('class', 'pause');
							}
						}
						
						(function(){
							if (that.options.gallery == true) {
								contentBoxAnim(120);
							} else {
								contentBoxAnim(160);
							}
						}).delay(250, this);
							
					}
				});
				
			});
		}
		
		// calling main functions
		if (that.options.gallery == true) { activeThumbnail(); }
		transition();
		periodical();		
	}
});