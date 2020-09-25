
;(function($) {

    /**
     * Plugin
     */

    $.fn.imagesGrid = function(options) {

        var args = arguments;

        return this.each(function() {

            // If options is plain object - destroy previous instance and create new
            if ($.isPlainObject(options)) {
                
                if (this._imgGrid instanceof ImagesGrid) {
                    this._imgGrid.destroy();
                    delete this._imgGrid;
                }

                var opts = $.extend({}, $.fn.imagesGrid.defaults, options);
                opts.element = $(this);
                this._imgGrid = new ImagesGrid(opts);

                return;
            }

            // If options is string - execute method
            if (typeof options === 'string' && this._imgGrid instanceof ImagesGrid) {
                switch (options) {
                    case 'modal.open':
                        this._imgGrid.modal.open(args[1]);
                        break;
                    case 'modal.close':
                        this._imgGrid.modal.close();
                        break;
                    case 'destroy':
                        this._imgGrid.destroy();
                        delete this._imgGrid;
                        break;
                }
            }

        });

    };

    /**
     * Plugin default options
     */

    $.fn.imagesGrid.defaults = {
        images: [],
        imagesRooms: [],
        imagesFac: [],
        imagesProp: [],
        imagesDin: [],
        imagesNear: [],
        cells: 7,
        align: false,
        nextOnClick: true,
        showViewAll: 'more',
        viewAllStartIndex: 'auto',
        loading: 'loading...',
        getViewAllText: function(imagesCount) {
            return 'View all  \n' + imagesCount + ' photos';
        },
        onGridRendered: $.noop,
        onGridItemRendered: $.noop,
        onGridLoaded: $.noop,
        onGridImageLoaded: $.noop,
        onModalOpen: $.noop,
        onModalClose: $.noop,
        onModalImageClick: $.noop,
        onModalImageUpdate: $.noop,
        onModalTabUpdate: $.noop
    };

    /**
     * ImagesGrid
     *   opts                    - Grid options 
     *   opts.element            - Element where to render images grid
     *   opts.images             - Array of images. Array item can be string or object { src, alt, title, caption, thumbnail }
     *   opts.align              - Align images with different height
     *   opts.cells              - Maximum number of cells (from 1 to 6)
     *   opts.showViewAll        - Show view all text:
     *                                'more'   - show if number of images greater than number of cells
     *                                'always' - always show
     *                                false    - never show
     *   opts.viewAllStartIndex  - Start image index when view all link clicked
     *   opts.getViewAllText     - Callback function returns text for "view all images" link
     *   opts.onGridRendered     - Callback function fired when grid items added to the DOM
     *   opts.onGridItemRendered - Callback function fired when grid item added to the DOM
     *   opts.onGridLoaded       - Callback function fired when grid images loaded
     *   opts.onGridImageLoaded  - Callback function fired when grid image loaded
     */

    function ImagesGrid(opts) {

        this.opts = opts || {};

        this.$window = $(window);
        this.$element = this.opts.element;
        this.$gridItems = [];

        this.modal = null;
        this.imageLoadCount = 0;

        var cells = this.opts.cells;
        this.opts.cells = (cells < 1)? 1: (cells > 7)? 7: cells;

        this.onWindowResize = this.onWindowResize.bind(this);
        this.onImageClick = this.onImageClick.bind(this);

        this.init();
    }

    ImagesGrid.prototype.init = function()  {

        this.setGridClass();
        this.renderGridItems();
        this.createModal();

        this.$window.on('resize', this.onWindowResize);
    }

    ImagesGrid.prototype.createModal = function() {

        var opts = this.opts;

        this.modal = new ImagesGridModal({
            loading: opts.loading,
            images: opts.images,
            imagesRooms: opts.imagesRooms,
            imagesFac: opts.imagesFac,
            imagesProp: opts.imagesProp,
            imagesDin: opts.imagesDin,
            imagesNear: opts.imagesNear,
            nextOnClick: opts.nextOnClick,
            onModalOpen: opts.onModalOpen,
            onModalClose: opts.onModalClose,
            onModalImageClick: opts.onModalImageClick,
            onModalImageUpdate: opts.onModalImageUpdate,
            onModalTabUpdate: opts.onModalTabUpdate
        });
    }

    ImagesGrid.prototype.setGridClass = function() {

        var opts = this.opts,
            imgsLen = opts.images.length,
            cellsCount = (imgsLen < opts.cells)? imgsLen: opts.cells;

        this.$element.addClass('imgs-grid imgs-grid-' + cellsCount);
    }

    ImagesGrid.prototype.renderGridItems = function() {

        var opts = this.opts,
            imgs = opts.images,
            imgsLen = imgs.length;

        if (!imgs) {
            return;
        }

        this.$element.empty();
        this.$gridItems = [];

        for (var i = 0; i < imgsLen; ++i) {
            if (i === opts.cells) {
                break;
            }
            this.renderGridItem(imgs[i], i);
        }

        if (opts.showViewAll === 'always' || 
            (opts.showViewAll === 'more' && imgsLen > opts.cells)
        ) {
            this.renderViewAll();
        }

        opts.onGridRendered(this.$element);
    }

    ImagesGrid.prototype.renderGridItem = function(image, index) {

        var src = image,
            alt = '',
            title = '',
            opts = this.opts,
            _this = this;

        if ($.isPlainObject(image)) {
            src = image.thumbnail || image.src;
            alt = image.alt || '';
            title = image.title || '';
        }

        var item = $('<div>', {
            class: 'imgs-grid-image',
            click: this.onImageClick,
            data: { index: index }
        });

        item.append(
            $('<div>', {
                class: 'image-wrap'
            }).append(
                $('<img>', {
                    src: src,
                    alt: alt,
                    title: title,
                    on: {
                        load: function(event) {
                            _this.onImageLoaded(event, $(this), image);
                        }
                    }
                })
            )
        );

        this.$gridItems.push(item);
        this.$element.append(item);

        opts.onGridItemRendered(item, image);
    }

    ImagesGrid.prototype.renderViewAll = function() {

        var opts = this.opts;

        this.$element.find('.imgs-grid-image:last .image-wrap').append(
            $('<div>', {
                class: 'view-all'
            }).append(
                $('<span>', {
                    class: 'view-all-cover',
                }),
                $('<span>', {
                    class: 'view-all-text',
                    text: opts.getViewAllText(opts.images.length)
                })
            )
        );
    }

    ImagesGrid.prototype.onWindowResize = function(event) {
        if (this.opts.align) {
            this.align();
        }
    }

    ImagesGrid.prototype.onImageClick = function(event) {

        var opts = this.opts,
            img = $(event.currentTarget),
            imageIndex;

        if (img.find('.view-all').length > 0 &&
            typeof opts.viewAllStartIndex === 'number' ) {
            imageIndex = opts.viewAllStartIndex;
        } else {
            imageIndex = img.data('index');
        }

        this.modal.open(imageIndex);
    }

    ImagesGrid.prototype.onImageLoaded = function(event, imageEl, image) {

        var opts = this.opts;

        ++this.imageLoadCount;

        opts.onGridImageLoaded(event, imageEl, image);

        if (this.imageLoadCount === this.$gridItems.length) {
            this.imageLoadCount = 0;
            this.onAllImagesLoaded()
        }
    }

    ImagesGrid.prototype.onAllImagesLoaded = function() {

        var opts = this.opts;

        if (opts.align) {
            this.align();
        }

        opts.onGridLoaded(this.$element);
    }

    ImagesGrid.prototype.align = function() {

        var itemsLen = this.$gridItems.length;

        switch (itemsLen) {
            case 2:
            case 3:
                this.alignItems(this.$gridItems);
                break;
            case 4:
                this.alignItems(this.$gridItems.slice(0, 2));
                this.alignItems(this.$gridItems.slice(2));
                break;
            case 5:
            case 6:
                this.alignItems(this.$gridItems.slice(0, 3));
                this.alignItems(this.$gridItems.slice(3));
                break;
        }
    }

    ImagesGrid.prototype.alignItems = function(items) {

        var itemsHeight = items.map(function(item) {
            return item.find('img').height();
        });

        var normalizedHeight = Math.min.apply(null, itemsHeight);

        $(items).each(function() {
            var item = $(this),
                imgWrap = item.find('.image-wrap'),
                img = item.find('img'),
                imgHeight = img.height();

            imgWrap.height(normalizedHeight);

            if (imgHeight > normalizedHeight) {
                var top = Math.floor((imgHeight - normalizedHeight) / 2);
                img.css({ top: -top });
            }
        });
    }

    ImagesGrid.prototype.destroy = function() {

        this.$window.off('resize',this.onWindowResize);

        this.$element.empty()
            .removeClass('imgs-grid imgs-grid-' + this.$gridItems.length);

        this.modal.destroy();
    }

    /**
     * ImagesGridModal 
     *  opts                    - Modal options
     *  opts.images             - Array of images
     *  opts.nextOnClick        - Show next image when click on modal image
     *  opts.loading            - Image loading text
     *  opts.onModalOpen        - Callback function called when modal opened
     *  opts.onModalClose       - Callback function called when modal closed
     *  opts.onModalImageClick  - Callback function called on modal image click
     */

    function ImagesGridModal(opts) {

        this.opts = opts || {};

        this.imageIndex = null;

        this.$document = $(document);
        this.$modal = null;
        this.$indicator = null;
        this.$tabContent = null;

        this.close = this.close.bind(this);
        this.prev = this.prev.bind(this);
        this.next = this.next.bind(this);
        this.onIndicatorClick = this.onIndicatorClick.bind(this);
        this.onTabClick = this.onTabClick.bind(this);
        this.onImageLoaded = this.onImageLoaded.bind(this);
        this.onKeyUp = this.onKeyUp.bind(this);

        this.$document.on('keyup', this.onKeyUp);
    }

    ImagesGridModal.prototype.open = function(imageIndex) {

        if (this.isOpened()) {
            return;
        }

        this.imageIndex = parseInt(imageIndex) || 0;
        this.render();
    }

    ImagesGridModal.prototype.close = function(event) {

        if (!this.$modal) {
            return;
        }

        var opts = this.opts;

        this.$modal.animate({
            opacity: 0
        }, {
            duration: 100,
            complete: function() {
                this.$modal.remove();
                this.$modal = null;
                this.$indicator = null;
                this.$tabContent = null;
                this.imageIndex = null;
                opts.onModalClose();
            }.bind(this)
        });
    }

    ImagesGridModal.prototype.isOpened = function() {
        return (this.$modal && this.$modal.is(':visible'));
    }

    ImagesGridModal.prototype.render = function() {

        var opts = this.opts;

        this.renderModal();
        this.renderCaption();
        this.renderCloseButton();
        this.renderInnerContainer();
        this.renderTabsContainer();
        this.renderTabsContentContainer(0);
        // this.renderIndicatorContainer();

        this.$modal.animate({
            opacity: 1
        }, {
            duration: 100,
            complete: function() {
                opts.onModalOpen(this.$modal, opts.images[this.imageIndex]);
            }.bind(this)
        });
    }

    ImagesGridModal.prototype.renderModal = function() {
        this.$modal = $('<div>', {
            class: 'imgs-grid-modal'
        }).appendTo('body');
    }

    ImagesGridModal.prototype.renderCaption = function() {
        this.$caption = $('<div>', {
            class: 'modal-caption',
            text: this.getImageCaption(this.imageIndex)
        }).appendTo(this.$modal);
    }

    ImagesGridModal.prototype.renderCloseButton = function() {
        this.$modal.append($('<div>', {
            class: 'modal-close',
            click: this.close
        }));
    }

    ImagesGridModal.prototype.renderInnerContainer = function() {

        var opts = this.opts,
            image = this.getImage(this.imageIndex);

        this.$modal.append(
            $('<div>', {
                class: 'modal-inner'
            }).append(
                $('<div>', {
                    class: 'modal-image'
                }).append(
                    $('<img>', {
                        src: image.src,
                        alt: image.alt,
                        title: image.title,
                        on: {
                            load: this.onImageLoaded,
                            click: function(event) {
                                this.onImageClick(event, $(this), image);
                            }.bind(this)
                        }
                    }),
                    $('<div>', {
                        class: 'modal-loader',
                        html: opts.loading
                    })
                ),
                $('<div>', {
                    class: 'modal-control left',
                    click: this.prev
                }).append(
                    $('<div>', {
                        class: 'arrow left'
                    })
                ),
                $('<div>', {
                    class: 'modal-control right',
                    click: this.next
                }).append(
                    $('<div>', {
                        class: 'arrow right'
                    })
                )
            )
        );

        if (opts.images.length <= 1) {
            this.$modal.find('.modal-control').hide();
        }
    }

    ImagesGridModal.prototype.renderIndicatorContainer = function() {

        var opts = this.opts,
            imgsLen = opts.images.length;

        if (imgsLen == 1) {
            return;
        }

        this.$indicator = $('<div>', {
            class: 'modal-indicator'
        });

        var list = $('<ul>'), i;
        for (i = 0; i < imgsLen; ++i) {
            list.append($('<li>', {
                class: this.imageIndex == i? 'selected': '',
                click: this.onIndicatorClick,
                data: { index: i }
            }));
        }

        this.$indicator.append(list);
        this.$modal.append(this.$indicator);
    }

    // Upadated one
    ImagesGridModal.prototype.renderTabsContainer = function() {

        var opts = this.opts,
            imgsLen = opts.images.length,
            imgsLenRooms = opts.imagesRooms.length,
            imgsLenFac = opts.imagesFac.length,
            imgsLenProp = opts.imagesProp.length,
            imgsLenDin= opts.imagesDin.length,
            imgsLenNear = opts.imagesNear.length;

        if (imgsLen == 1) {
            return;
        }

        this.$tab = $('<div>', {
            class: 'modal-tabs ajax-tab'
        });

        var list = $('<ul>'), i;
        // for (i = 0; i < imgsLen; ++i) {
            list.append(
                $('<li>', {
                    class: '',
                }).append(
                    $('<a>', {
                        class: 'active',
                        href: '#all',
                        html: 'All ('+imgsLen+')',
                        click: this.onTabClick,
                        data: { index: 0 }
                    })
                ),
                $('<li>', {
                    class: '',
                }).append(
                    $('<a>', {
                        class: '',
                        href: '#rooms',
                        html: 'Rooms ('+imgsLenRooms+')',
                        click: this.onTabClick,
                        data: { index: 1 }
                    })
                ),
                $('<li>', {
                    class: '',
                }).append(
                    $('<a>', {
                        class: '',
                        href: '#facilities',
                        html: 'Facilities ('+imgsLenFac+')',
                        click: this.onTabClick,
                        data: { index: 2 }
                    })
                ),
                $('<li>', {
                    class: '',
                }).append(
                    $('<a>', {
                        class: '',
                        href: '#property-views',
                        html: 'Property views ('+imgsLenProp+')',
                        click: this.onTabClick,
                        data: { index: 3 }
                    })
                ),
                $('<li>', {
                    class: '',
                }).append(
                    $('<a>', {
                        class: '',
                        href: '#dining',
                        html: 'Dining ('+imgsLenDin+')',
                        click: this.onTabClick,
                        data: { index: 4 }
                    })
                ),
                $('<li>', {
                    class: '',
                }).append(
                    $('<a>', {
                        class: '',
                        href: '#nearby-attraction',
                        html: 'Nearby attraction ('+imgsLenNear+')',
                        click: this.onTabClick,
                        data: { index: 5 }
                    })
                )
            );
        // }

        this.$tab.append(list);
        this.$modal.append(this.$tab);
    }

    ImagesGridModal.prototype.tabImageLength = function(tabIndex) {
        var opts = this.opts,
            imgsLen = opts.images.length;
        if(tabIndex == 0){
            imgsLen = opts.images.length;
        } else if(tabIndex == 1){
            imgsLen = opts.imagesRooms.length;
        } else if(tabIndex == 2){
            imgsLen = opts.imagesFac.length;
        } else if(tabIndex == 3){
            imgsLen = opts.imagesProp.length;
        } else if(tabIndex == 4){
            imgsLen = opts.imagesDin.length;
        } else if(tabIndex == 5){
            imgsLen = opts.imagesNear.length;
        }
        return imgsLen;
    }
    ImagesGridModal.prototype.renderTabsContentContainer = function(tabIndex) {
        var opts = this.opts,
        imgsLen = this.tabImageLength(tabIndex);
        // console.log(imgsLen);

        this.$tabContent = $('<div>', {
            class: 'modal-contents ajax-content'
        });

        var content = $('<ul>'),i;
        for (i = 0; i < imgsLen; ++i) {
            image = this.getTabImage(i, tabIndex);
            content.append(
                $('<li>', {
                    class: this.imageIndex == i? 'selected': '',
                    // click: this.onIndicatorClick,
                    // data: { index: i }
                }).append(
                    $('<img>', {
                        src: image.src,
                        alt: image.alt,
                        title: image.title,
                        data: { index: i,tabIndex: tabIndex },
                        width: '70px',
                        height: '50px',
                        on: {
                            load: this.onImageLoaded,
                            click: function(event) {
                                this.onTabImageClick(event);
                            }.bind(this)
                        }
                    })
                )
            );
        }

        this.$tabContent.append(content);
        this.$modal.append(this.$tabContent);
    }


    ImagesGridModal.prototype.prev = function() {

        var imgsLen = this.opts.images.length;

        if (this.imageIndex > 0) {
            --this.imageIndex;
        } else {
            this.imageIndex = imgsLen - 1;
        }

        this.updateImage();
    }

    ImagesGridModal.prototype.next = function() {

        var imgsLen = this.opts.images.length;

        if (this.imageIndex < imgsLen - 1) {
            ++this.imageIndex;
        } else {
            this.imageIndex = 0;
        }

        this.updateImage();
    }

    ImagesGridModal.prototype.updateImage = function() {

        var opts = this.opts,
            image = this.getImage(this.imageIndex),
            imageEl = this.$modal.find('.modal-image img');

        imageEl.attr({
            src: image.src,
            alt: image.alt,
            title: image.title
        });

        this.$modal.find('.modal-caption').text(
            this.getImageCaption(this.imageIndex) );

        if (this.$indicator) {
            var indicatorList = this.$indicator.find('ul');
            indicatorList.children().removeClass('selected');
            indicatorList.children().eq(this.imageIndex).addClass('selected');
        }

        this.showLoader();

        opts.onModalImageUpdate(imageEl, image);
    }

    ImagesGridModal.prototype.onImageClick = function(event, imageEl, image) {
        var opts = this.opts;
        if (opts.nextOnClick) {
            this.next();
        }
        opts.onModalImageClick(event, imageEl, image);
    }

    ImagesGridModal.prototype.onTabImageClick = function(event) {

        // var opts = this.opts,
        //     img = $(event.currentTarget),
        //     imageIndex = img.data('index');
        // this.imageIndex = parseInt(imageIndex) || 0;
        // this.updateImage();

        var index = $(event.target).data('index'),
            tabIndex = $(event.target).data('tabIndex');
        this.imageIndex = index;
        console.log(this.imageIndex);
        console.log(index);
        this.updateTabImage(index,tabIndex);
    }

    ImagesGridModal.prototype.onImageLoaded = function() {
        this.hideLoader();
    }

    ImagesGridModal.prototype.onIndicatorClick = function(event) {
        var index = $(event.target).data('index');
        this.imageIndex = index;
        this.updateImage();
    }

    ImagesGridModal.prototype.updateTabImage = function(index,tabIndex) {

        var opts = this.opts,
            image = this.getTabImage(index, tabIndex),
            // tabImage = this.getTabImage(this.imageIndex, tabIndex),
            imageEl = this.$modal.find('.modal-image img');

        // console.log(tabIndex);
        imageEl.attr({
            src: image.src,
            alt: image.alt,
            title: image.title
        });

        this.$modal.find('.modal-caption').text(
            this.getImageCaption(this.imageIndex) );

        if (this.$tab) {
            var tabList = this.$tab.find('ul');
            tabList.children().children().removeClass('active');
            tabList.children().children().eq(tabIndex).addClass('active');
        }
        this.showLoader();
        opts.onModalTabUpdate(imageEl, image);
    }

    ImagesGridModal.prototype.updateTabContent = function(tabIndex) {
        var opts = this.opts,image,
        imgsLen = this.tabImageLength(tabIndex);
        // console.log(imgsLen);

        var content = $('.modal-contents').find('ul'),i;
        content.empty();
        for (i = 0; i < imgsLen; ++i) {
            image = this.getTabImage(i, tabIndex);
            content.append(
                $('<li>', {
                    class: '',
                }).append(
                    $('<img>', {
                        src: image.src,
                        alt: image.alt,
                        title: image.title,
                        data: { index: i,tabIndex: tabIndex },
                        width: '70px',
                        height: '50px',
                        on: {
                            load: this.onImageLoaded,
                            click: function(event) {
                                this.onTabImageClick(event);
                            }.bind(this)
                        }
                    })
                )
            );
        }
    }

    ImagesGridModal.prototype.onTabClick = function(event) {
        var tabIndex = $(event.target).data('index');
        // this.tabIndex = index;
        // this.updateImage();
        this.updateTabContent(tabIndex);
        this.updateTabImage(0,tabIndex);
    }

    ImagesGridModal.prototype.onKeyUp = function(event) {

        if (!this.$modal) {
            return;
        }

        switch (event.keyCode) {
            case 27: // Esc
                this.close();
                break;
            case 37: // Left arrow
                this.prev();
                break;
            case 39: // Right arrow
                this.next();
                break;
        }
    }

    ImagesGridModal.prototype.getImage = function(index) {

        var opts = this.opts,
            image = opts.images[index];

        if ($.isPlainObject(image)) {
            return image;
        } else {
            return { src: image, alt: '', title: '' }
        }
    }

    ImagesGridModal.prototype.getTabImage = function(index, tabIndex) {
        var opts = this.opts,
        image = opts.images[index];
        if(tabIndex == 0){
            image = opts.images[index];
        } else if(tabIndex == 1){
            image = opts.imagesRooms[index];
        } else if(tabIndex == 2){
            image = opts.imagesFac[index];
        } else if(tabIndex == 3){
            image = opts.imagesProp[index];
        } else if(tabIndex == 4){
            image = opts.imagesDin[index];
        } else if(tabIndex == 5){
            image = opts.imagesNear[index];
        }

        // console.log(image);

        if ($.isPlainObject(image)) {
            return image;
        } else {
            return { src: image, alt: '', title: '' }
        }
    }

    ImagesGridModal.prototype.getImageCaption = function(imgIndex) {
        var img = this.getImage(imgIndex);
        return img.caption || '';
    }

    ImagesGridModal.prototype.showLoader = function() {
        if (this.$modal) {
            this.$modal.find('.modal-image img').hide();
            this.$modal.find('.modal-loader').show();
        }
    }

    ImagesGridModal.prototype.hideLoader = function() {
        if (this.$modal) {
            this.$modal.find('.modal-image img').show();
            this.$modal.find('.modal-loader').hide();
        }
    }

    ImagesGridModal.prototype.destroy = function() {
        this.$document.off('keyup', this.onKeyUp);
        this.close();
    }

})(jQuery);
