; (function ($, window, document, undefined) {

  //定义Slide的构造函数
  var Slide = function (ele, opt) {
    this.$element = ele,
      this.defaults = {

        type: 1,//1滑动验证码 2拼图验证码
        mode: 'fixed',	//弹出式pop，固定fixed
        vOffset: 5,
        vSpace: 5,
        explain: '向右拖动滑块填充拼图 >>',
        getImgUrl: '/api/home/slide_get_img',
        verifyImg: '/api/home/slide_verify',
        imgSize: {
          width: '398px',
          height: '200px',
        },
        circleRadius: '10px',
        barSize: {
          width: '398px',
          height: '60px',
        },
        moveSize: {
          width: '60px',
          height: '60px',
        },
        jigsawSize: {
          width: '50px',
          height: '50px',
        },
        csrf_id: null,
        ready: function () {
        },
        success: function () {
        },
        error: function () {
        }

      },
      this.options = $.extend({}, this.defaults, opt);
  };

  //定义Slide的方法
  Slide.prototype = {

    init: function () {
      var _this = this;

      //加载页面
      this.getImg();
      this.options.ready();

    },

    initFn: function () {

      var _this = this;

      _this.loadDom();

      this.$element[0].onselectstart = document.body.ondrag = function () {
        return false;
      };

      if (this.options.mode == 'pop') {
        this.$element.on('mouseover', function (e) {
          _this.showImg();
        });

        this.$element.on('mouseout', function (e) {
          _this.hideImg();
        });


        this.htmlDoms.out_panel.on('mouseover', function (e) {
          _this.showImg();
        });

        this.htmlDoms.out_panel.on('mouseout', function (e) {
          _this.hideImg();
        });
      }

      //按下
      this.htmlDoms.move_block.on('touchstart', function (e) {
        // e.preventDefault();
        _this.start(e);
      });

      this.htmlDoms.move_block.on('mousedown', function (e) {
        _this.start(e);
      });

      //拖动
      window.addEventListener("touchmove", function (e) {
        e.preventDefault();
        _this.move(e);
      });


      window.addEventListener("mousemove", function (e) {
        // e.preventDefault();
        _this.move(e);
      });

      //鼠标松开
      window.addEventListener("touchend", function () {
        // e.preventDefault();
        _this.end();
      });
      window.addEventListener("mouseup", function () {
        _this.end();
      });

      //刷新
      _this.$element.find('.verify-refresh').on('click', function () {
        _this.refresh();
      });
    },

    getImg: function () {
      var _this = this;

      ZK.post({
        url: this.options.getImgUrl,
        isCoverSuccess: true,
        notLoading: true,
        isShowWaitTip: false,
        data: {
          csrf_id: this.createId()
        },
        success: function (res) {
          if (res.Code === "Success") {
            _this.options.img_bg = res.Data.img_bg;
            _this.options.img_small = res.Data.img_small;
            _this.options.position_x = res.Data.position_x;
            _this.options.position_y = res.Data.position_y;

            _this.initFn();
          }
        },
      });
    },

    // 每个图片生成一个不重复的ID
    createId: function () {
      this.options.csrf_id = (Math.random() * 10000000).toString(16).substr(0, 4) + '-' + (new Date()).getTime() + '-' + Math.random().toString().substr(2, 5);
      return this.options.csrf_id;
    },

    // 初始化加载DOM
    loadDom: function () {

      this.status = false;	//鼠标状态
      this.isEnd = false;		//是够验证完成
      this.setSize = this.resetSize(this);	//重新设置宽度高度
      this.plusWidth = 0;
      this.plusHeight = 0;
      this.x = 0;
      this.y = 0;
      var panelHtml = '';
      var tmpHtml = '';
      this.lengthPercent = (parseFloat(this.setSize.img_width) - parseFloat(this.setSize.jigsaw_width)) / (parseFloat(this.setSize.img_width) - parseFloat(this.setSize.move_width));

      if (this.options.type != 1) {		//图片滑动

        panelHtml += '<div class="verify-img-out"><div class="verify-img-panel"><div class="verify-refresh" style="z-index:3"><i class="iconfont icon-refresh"></i></div></div></div>';

        this.plusWidth = parseInt(this.setSize.block_width) + parseInt(this.setSize.circle_radius) * 2 - parseInt(this.setSize.circle_radius) * 0.2;
        this.plusHeight = parseInt(this.setSize.block_height) + parseInt(this.setSize.circle_radius) * 2 - parseInt(this.setSize.circle_radius) * 0.2;

        // tmpHtml = '<canvas class="verify-sub-block"  width="'+this.plusWidth+'" height="'+this.plusHeight+'" style="left:0; position:absolute;" ></canvas>';
        tmpHtml = '<div class="verify-jigsaw-out"></div><input type="hidden" id="csrf_id" name="csrf_id" value="" /><input type="hidden" id="slide_token" name="slide_token" value="" />';
      }

      panelHtml += tmpHtml + '<div class="verify-bar-area"><span  class="verify-msg">' + this.options.explain + '</span><div class="verify-left-bar"><div  class="verify-move-block">>></div></div></div>';
      this.$element.append(panelHtml);

      this.htmlDoms = {
        sub_block: this.$element.find('.verify-sub-block'),
        out_panel: this.$element.find('.verify-img-out'),
        img_panel: this.$element.find('.verify-img-panel'),
        img_canvas: this.$element.find('.verify-img-canvas'),
        out_jigsaw: this.$element.find('.verify-jigsaw-out'),
        bar_area: this.$element.find('.verify-bar-area'),
        move_block: this.$element.find('.verify-move-block'),
        left_bar: this.$element.find('.verify-left-bar'),
        msg: this.$element.find('.verify-msg'),
        icon: this.$element.find('.verify-icon'),
        refresh: this.$element.find('.verify-refresh'),
      };


      this.$element.css('position', 'relative');
      if (this.options.mode == 'pop') {
        this.htmlDoms.out_panel.css({ 'display': 'none', 'position': 'absolute', 'bottom': '62px' });
        this.htmlDoms.sub_block.css({ 'display': 'none' });
        this.htmlDoms.out_jigsaw.css({ 'top': -(parseInt(this.setSize.img_height) + this.options.vSpace - this.options.position_y) });
      } else {
        this.htmlDoms.out_panel.css({ 'position': 'relative' });
        this.htmlDoms.out_jigsaw.css({ 'display': 'block', 'top': parseInt(this.options.position_y) });
      }

      this.htmlDoms.out_panel.css('height', parseInt(this.setSize.img_height) + this.options.vSpace + 'px');
      this.htmlDoms.img_panel.css({
        'width': this.setSize.img_width,
        'height': this.setSize.img_height,
        'background-image': 'url(' + this.options.img_bg + ')'
      });
      this.htmlDoms.out_jigsaw.css({
        'width': this.setSize.jigsaw_width,
        'height': this.setSize.jigsaw_height,
        'background-image': 'url(' + this.options.img_small + ')',
        // 'top': -(parseInt(this.setSize.img_height) + this.options.vSpace - this.options.position_y)
      });
      this.htmlDoms.bar_area.css({
        'width': this.setSize.bar_width,
        'height': this.setSize.bar_height,
        'line-height': this.setSize.bar_height
      });
      this.htmlDoms.move_block.css({ 'width': this.setSize.move_width, 'height': this.setSize.move_height });
      this.htmlDoms.left_bar.css({ 'width': this.setSize.move_width, 'height': this.setSize.move_height });

      // this.randSet();
    },

    //鼠标按下
    start: function (e) {
      if (this.isEnd == false) {
        this.htmlDoms.msg.html('');
        // this.htmlDoms.move_block.css('background-color', '#337ab7');
        this.htmlDoms.left_bar.css('border-color', '#337AB7');
        this.htmlDoms.icon.css('color', '#fff');
        e.stopPropagation();
        this.status = true;
      }
    },

    //鼠标移动
    move: function (e) {
      if (this.status && this.isEnd == false) {
        if (this.options.mode == 'pop') {
          this.showImg();
        }

        if (!e.touches) {    //兼容移动端
          var x = e.clientX;
        } else {     //兼容PC端
          var x = e.touches[0].pageX;
        }
        var bar_area_left = Slide.prototype.getLeft(this.htmlDoms.bar_area[0]);
        var move_block_left = x - bar_area_left; //小方块相对于父元素的left值

        if (this.options.type != 1) {		//图片滑动
          if (move_block_left >= (this.htmlDoms.bar_area[0].offsetWidth - parseInt(this.setSize.move_width) + parseInt(parseInt(this.setSize.jigsaw_width) / 2) - 2)) {
            move_block_left = (this.htmlDoms.bar_area[0].offsetWidth - parseInt(this.setSize.move_width) + parseInt(parseInt(this.setSize.jigsaw_width) / 2) - 2);
          }
        } else {		//普通滑动
          if (move_block_left >= this.htmlDoms.bar_area[0].offsetWidth - parseInt(parseInt(this.setSize.bar_height) / 2) + 3) {
            this.$element.find('.verify-msg:eq(1)').text('松开验证');
            move_block_left = this.htmlDoms.bar_area[0].offsetWidth - parseInt(parseInt(this.setSize.bar_height) / 2) + 3;
          } else {
            this.$element.find('.verify-msg:eq(1)').text('');
          }
        }

        if (move_block_left <= parseInt(parseInt(this.setSize.jigsaw_width) / 2)) {
          move_block_left = parseInt(parseInt(this.setSize.jigsaw_width) / 2);
        }


        //拖动后小方块的left值
        this.htmlDoms.move_block.css('left', move_block_left - parseInt(parseInt(this.setSize.jigsaw_width) / 2) + "px");
        this.htmlDoms.left_bar.css('width', move_block_left - parseInt(parseInt(this.setSize.jigsaw_width) / 2) + "px");
        this.htmlDoms.out_jigsaw.css('left', (move_block_left - parseInt(parseInt(this.setSize.jigsaw_width) / 2)) * this.lengthPercent + "px");

      }
    },

    //鼠标松开
    end: function () {

      var _this = this;


      //判断是否重合
      if (this.status && this.isEnd == false) {

        if (this.options.type != 1) {		//图片滑动
          var left = this.htmlDoms.out_jigsaw.css('left'),
            leftNum = left.substring(0, left.length - 2) * 1000;

          ZK.post({
            url: this.options.verifyImg,
            isCoverSuccess: true,
            notLoading: true,
            isShowWaitTip: false,
            data: {
              csrf_id: this.options.csrf_id,
              x_value: leftNum
            },
            success: function (res) {
              if (res.Code === "Success") {
                if (res.Data.result) {
                  // 验证成功
                  // _this.htmlDoms.move_block.css('background-color', '#5cb85c');
                  _this.htmlDoms.left_bar.hide();
                  _this.htmlDoms.refresh.hide();
                  _this.htmlDoms.msg.html('<span class="icon-success"></span>验证通过');
                  _this.htmlDoms.bar_area.addClass('success-slider');
                  _this.isEnd = true;
                  $("#csrf_id").val(_this.options.csrf_id);
                  $("#slide_token").val(res.Data.validate);
                  // 验证成功不展示图片
                  _this.$element.off('mouseover');
                  _this.options.success(this);
                } else {
                  // _this.htmlDoms.move_block.css('background-color', '#d9534f');
                  _this.htmlDoms.left_bar.css('border-color', '#d9534f');
                  _this.htmlDoms.bar_area.addClass('again-slider');

                  setTimeout(function () {
                    _this.refresh();
                    _this.htmlDoms.msg.html('再次尝试拖动拼图 >>')
                  }, 400);

                  _this.options.error(this);
                }

              }
            },
          });

        } else {		//普通滑动

          if (parseInt(this.htmlDoms.move_block.css('left')) >= (parseInt(this.setSize.bar_width) - parseInt(this.setSize.bar_height) - parseInt(this.options.vOffset))) {
            this.htmlDoms.move_block.css('background-color', '#5cb85c');
            this.htmlDoms.left_bar.css({ 'color': '#4cae4c', 'border-color': '#5cb85c', 'background-color': '#fff' });
            this.htmlDoms.icon.css('color', '#fff');
            this.htmlDoms.icon.removeClass('icon-right');
            this.htmlDoms.icon.addClass('icon-check');
            this.htmlDoms.refresh.hide();
            this.$element.find('.verify-msg:eq(1)').text('验证成功');
            this.isEnd = true;
            this.options.success(this);
          } else {
            this.$element.find('.verify-msg:eq(1)').text('');
            this.htmlDoms.move_block.css('background-color', '#d9534f');
            this.htmlDoms.left_bar.css('border-color', '#d9534f');
            this.htmlDoms.icon.css('color', '#fff');
            this.htmlDoms.icon.removeClass('icon-right');
            this.htmlDoms.icon.addClass('icon-close');
            this.isEnd = true;

            setTimeout(function () {
              _this.$element.find('.verify-msg:eq(1)').text('');
              _this.refresh();
              _this.isEnd = false;
            }, 400);

            this.options.error(this);
          }
        }

        this.status = false;
      }
    },

    //弹出式
    showImg: function () {
      this.htmlDoms.out_panel.stop().fadeIn();
      this.htmlDoms.out_jigsaw.stop().fadeIn();
    },

    //固定式
    hideImg: function () {
      this.htmlDoms.out_panel.stop().fadeOut();
      this.htmlDoms.out_jigsaw.stop().fadeOut();
    },

    resetSize: function (obj) {
      var img_width, img_height, bar_width, bar_height, move_width, move_height, circle_radius, jigsaw_width,
        jigsaw_height;	//图片的宽度、高度，移动条的宽度、高度
      var parentWidth = obj.$element.parent().width() || $(window).width();
      var parentHeight = obj.$element.parent().height() || $(window).height();

      if (obj.options.imgSize.width.indexOf('%') != -1) {
        img_width = parseInt(obj.options.imgSize.width) / 100 * parentWidth + 'px';
      } else {
        img_width = obj.options.imgSize.width;
      }

      if (obj.options.imgSize.height.indexOf('%') != -1) {
        img_height = parseInt(obj.options.imgSize.height) / 100 * parentHeight + 'px';
      } else {
        img_height = obj.options.imgSize.height;
      }

      if (obj.options.barSize.width.indexOf('%') != -1) {
        bar_width = parseInt(obj.options.barSize.width) / 100 * parentWidth + 'px';
      } else {
        bar_width = obj.options.barSize.width;
      }

      if (obj.options.barSize.height.indexOf('%') != -1) {
        bar_height = parseInt(obj.options.barSize.height) / 100 * parentHeight + 'px';
      } else {
        bar_height = obj.options.barSize.height;
      }

      if (obj.options.moveSize.width.indexOf('%') != -1) {
        move_width = parseInt(obj.options.moveSize.width) / 100 * parentWidth + 'px';
      } else {
        move_width = obj.options.moveSize.width;
      }

      if (obj.options.moveSize.height.indexOf('%') != -1) {
        move_height = parseInt(obj.options.moveSize.height) / 100 * parentHeight + 'px';
      } else {
        move_height = obj.options.moveSize.height;
      }

      if (obj.options.jigsawSize.width.indexOf('%') != -1) {
        jigsaw_width = parseInt(obj.options.jigsawSize.width) / 100 * parentWidth + 'px';
      } else {
        jigsaw_width = obj.options.jigsawSize.width;
      }

      if (obj.options.jigsawSize.height.indexOf('%') != -1) {
        jigsaw_height = parseInt(obj.options.jigsawSize.height) / 100 * parentHeight + 'px';
      } else {
        jigsaw_height = obj.options.jigsawSize.height;
      }

      if (obj.options.circleRadius) {
        if (obj.options.circleRadius.indexOf('%') != -1) {
          circle_radius = parseInt(obj.options.circleRadius) / 100 * parentHeight + 'px';
        } else {
          circle_radius = obj.options.circleRadius;
        }
      }

      return {
        img_width: img_width,
        img_height: img_height,
        bar_width: bar_width,
        bar_height: bar_height,
        circle_radius: circle_radius,
        jigsaw_width: jigsaw_width,
        jigsaw_height: jigsaw_height,
        move_width: move_width,
        move_height: move_height
      };
    },

    //刷新
    refresh: function () {
      var _this = this;
      // 重新绑定实践
      this.$element.on('mouseover', function (e) {
        _this.showImg();
      });
      this.htmlDoms.refresh.show();
      _this.htmlDoms.left_bar.show();
      _this.htmlDoms.refresh.show();
      this.$element.find('.verify-msg:eq(1)').text('');
      this.$element.find('.verify-msg:eq(1)').css('color', '#000');
      _this.htmlDoms.bar_area.removeClass('success-slider');
      this.htmlDoms.move_block.animate({ 'left': '0px' }, 'fast');
      this.htmlDoms.left_bar.animate({ 'width': parseInt(this.setSize.bar_height) }, 'fast');
      this.htmlDoms.left_bar.css({ 'border-color': '#ddd' });

      this.htmlDoms.move_block.css('background-color', '#0055FE');

      this.$element.find('.verify-msg:eq(0)').text(this.options.explain);

      this.isEnd = false;

      this.htmlDoms.out_jigsaw.css('left', "0px");
      ZK.post({
        url: this.options.getImgUrl,
        isCoverSuccess: true,
        notLoading: true,
        isShowWaitTip: false,
        data: {
          csrf_id: this.createId()
        },
        success: function (res) {
          if (res.Code === "Success") {
            _this.options.img_bg = res.Data.img_bg;
            _this.options.img_small = res.Data.img_small;
            _this.options.position_x = res.Data.position_x;
            _this.options.position_y = res.Data.position_y;

            _this.htmlDoms.img_panel.css({ 'background-image': 'url(' + res.Data.img_bg + ')' });
            if (_this.options.mode == 'fixed') {
              _this.htmlDoms.out_jigsaw.css({
                'top': parseInt(_this.options.position_y),
                'background-image': 'url(' + res.Data.img_small + ')',
              });
            } else {
              _this.htmlDoms.out_jigsaw.css({
                'background-image': 'url(' + res.Data.img_small + ')',
                'top': -(parseInt(_this.setSize.img_height) + _this.options.vSpace - res.Data.position_y)
              });
            }
          }
        },
      });
    },

    //获取left值
    getLeft: function (node) {
      var left = $(node).offset().left;
      return left;
    },
    //以下内容为兼容移动端的事件 start-------
    //判断是移动端还是pc

    //以下内容为兼容移动端的事件 end-------
  };

  //在插件中使用slideVerify对象
  ZK.slideVerify = function (container, options, callbacks) {
    var $container = $(container);
    var slide = new Slide($container, options);
    ZK.slideVerify.slide = slide;
    slide.init();
  };


})(jQuery, window, document);