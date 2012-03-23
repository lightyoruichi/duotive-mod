/* *********************/
/*                     */
/*   duotive Gallery   */
/*                     */
/* *********************/

var dtFullWidthGallery = new Class({
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
		// adding hover effects to the thumbnails
		slides = $$('#fullWidthGalleryUl a');
		slides.each(function(item){
			var child = item.getElement('span.border');
			child.setStyle('opacity', 0);
			var childFx = new Fx.Tween(child, {duration: 200});
			item.addEvents({
				'mouseenter':function(){
					childFx.cancel();
					childFx.start('opacity', 1);
				},
				'mouseleave':function(){
					childFx.cancel();
					childFx.start('opacity', 0);
				}
			});
		});
		
		// image preloader
		var images = $$('#fullWidthGallery img');
		var imagesSrc = [];
		images.each(function(item, index){
			imagesSrc[index] = item.getProperty('src');
					
		});
		imagesAsset = Asset.images(imagesSrc, {
		    onComplete: function(){
				slides.setStyle('display', 'block');	
				that.play();
			}
		});	
		
	},
	
	setupGallery: function(){	
		// setting up the gallery parameters
		galleryUl = $$('#fullWidthGalleryUl');
		galleryUl = galleryUl[0];
		galleryLi = galleryUl.getChildren('li');
		galleryLiWidth = that.options.thumbLiWidth;
		galleryUlWidth = galleryLi.length * galleryLiWidth;
		galleryUl.setStyle('width', galleryUlWidth);
		galleryItems = galleryLi.length;
	},
	
	play: function(){
		counter = 0;
		
		// gallery effects
		var galleryFx = new Fx.Tween(galleryUl, {
				duration: that.options.transitionDuration, 
				transition: Fx.Transitions.Linear,
				wait: false
			}
		);
		function animateGallery(value){
			galleryFx.cancel();
			galleryFx.start('left', -value);
		}
		
		
		// transition function
		function transition(){
			var clientWindowWidth = parseInt(that.options.container.getStyle('width'), 10);
			itemsDisplayed = parseInt(clientWindowWidth / that.options.thumbLiWidth, 10);
			
			// when last item is displayed reset counter
			var galleryPos = counter * that.options.thumbLiWidth;
			if (galleryPos > galleryUlWidth - clientWindowWidth) {
				galleryPos = 0;
				counter = 0;
			}
					
			// display last item correctly
			if (counter == (galleryItems - itemsDisplayed)-1) {
				galleryPos = galleryUlWidth - clientWindowWidth;
			}
			
			// if there aren't enough elements to fill the screen, center the gallery
			if (galleryUlWidth < clientWindowWidth) {
				galleryPos = -parseInt((clientWindowWidth - galleryUlWidth)/2, 10);
			}
			animateGallery(galleryPos);
			counter++;
		}
		
		// gallery loop		
		function periodical(){
			play = (function(){
				transition();
			}).periodical(that.options.transitionInterval);
		}
		
		// setting up the gallery controls	
		var galleryControlLeft = $$('#gallery-control-left');
			galleryControlLeft = galleryControlLeft[0];
			galleryControlLeft.addEvents({
				'click':function(){
					counter = counter - 2;
					if (counter <= 0) {
						counter = (galleryItems - itemsDisplayed)-1;
					}
					$clear(play);
					transition();
					periodical();
				}
			});
			
		var galleryControlRight = $$('#gallery-control-right');
			galleryControlRight = galleryControlRight[0];
			galleryControlRight.addEvents({
				'click':function(){
					$clear(play);
					transition();
					periodical();
				}
			});
			
		// adding events to prettyPhoto	
		function prettyPhotoEvents(){
			var pp_Close = $$('a.pp_close');		
			if (pp_Close != null) {
				$clear(play);
				pp_Close = pp_Close[0];
				pp_Close.addEvents({
					'click':function(){
						periodical();
					}
				});
			}
			var ppOverlay = $$('div.pp_overlay');
			if (ppOverlay != null) {
				$clear(play);
				ppOverlay = ppOverlay[0];
				ppOverlay.addEvents({
					'click':function(){
						periodical();
					}
				});
			}	
		}
		
		// when an image is clicked
		slides.each(function(item){
			item.addEvents({
				'click':function(){
					prettyPhotoEvents();
				}
			});
		});	
		
		// triggering the main functions
		animateGallery(0);
		transition();
		periodical();

		
	}	
	
});






















