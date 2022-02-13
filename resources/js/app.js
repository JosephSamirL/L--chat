/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});


$('#sub').on('submit', function(e){
    e.preventDefault();
    var $this = $(this);

    $.ajax({
        url: $this.prop('action'),
        method: 'post',
        data: $this.serialize(),
    }).done(function(response){
        $.ajax({  //create an ajax request to display.php
            type: "GET",
            url: "/messages",
            success: function (data) {
                $.ajax({  //create an ajax request to display.php
                    type: "GET",
                    url: "/users",
                    success: function (dataa) {
                        $("html, body, .card-body").animate({ scrollTop: 70000000000 }, 10);
                       let user = dataa.filter((item)=>{
                            return item.id == data[data.length - 1].user_id;
                        })

                        $(`<div data-id=${data[data.length - 1].id} class="message-container"><p><span class="message-sender you">you</span> ${data[data.length - 1].text}</p> <div class="deleteTheProduct"><form method="POST" action="/destroy" class="formDeleteProduct new"><input type="hidden" name="_token" value=${$(".formDeleteProduct>input[name='_token']").val()}> <input name="id" type="hidden" value=${data[data.length - 1].id}>                                  <button type="button">
                                         <svg width="6" height="29" viewBox="0 0 6 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                                             <circle cx="2.5" cy="3" r="2.5" fill="#ADB5BD"/>
                                             <circle cx="2.5" cy="14" r="2.5" fill="#ADB5BD"/>
                                             <circle cx="2.5" cy="25" r="2.5" fill="#ADB5BD"/>
                                         </svg>


                                     </button> <button style="display: none" type="submit">Remove</button></form></div></div>`).insertBefore("#sub")
                        $('.formDeleteProduct.new').on('submit', function(e) {

                            e.preventDefault()
                            let _this = this
                            var dataId = $(this).children("button").attr('data-id');

                            $.ajax({
                                url: '/destroy',
                                type: 'POST',
                                data: $(this).serialize(),
                                success: function( msg ) {

                                    let number = $(_this).children("input[name='id']").val()
                                    $(`div[data-id=${number}]`).remove();


                                },
                                error: function( data ) {
                                    if ( data.status === 422 ) {
                                        // toastr.error('Cannot delete the category');
                                    }
                                }
                            });

                            return false;
                        });

                    }
                });

            }
        });
    })

});
// handling Room logic

$('#subroom').on('submit', function(e){
    e.preventDefault();
    var $this = $(this);

    $.ajax({
        url: $this.prop('action'),
        method: 'post',
        data: $this.serialize(),
    }).done(function(response){
        $.ajax({  //create an ajax request to display.php
            type: "GET",
            url: "/roomies",
            success: function (data) {
                $.ajax({  //create an ajax request to display.php
                    type: "GET",
                    url: "/users",
                    success: function (dataa) {
                        $("html, body, .card-body").animate({ scrollTop: 70000000000 }, 10);
                        let user = dataa.filter((item)=>{
                            return item.id == data[data.length - 1].user_id;
                        })


                        $(".rooms_container").append(`
                        <a href="room/${data[data.length - 1].id}" class="rooms_link">${data[data.length - 1].name}
                        <form method="POST" action="/destroyRoom" class="formDeleteProductRooms new"><input type="hidden" name="_token" value=${$(".formDeleteProductRooms>input[name='_token']").val()}> <input name="id" type="hidden" value=${data[data.length - 1].id}>
                        <button style="display: block" type="submit">Remove</button>
                        </form>
                        </a>
                        `)

                        $('.formDeleteProductRooms.new').on('submit', function(e) {

                            e.preventDefault()
                            let _this = this
                            var dataId = $(this).children("button").attr('data-id');

                            $.ajax({
                                url: '/destroyRoom',
                                type: 'POST',
                                data: $(this).serialize(),
                                success: function( msg ) {
                                    $(_this).parents("a").remove();
                                    let number = $(_this).children("input[name='id']").val()
                                    $(`div[data-id=${number}]`).remove();


                                },
                                error: function( data ) {
                                    if ( data.status === 422 ) {
                                        // toastr.error('Cannot delete the category');
                                    }
                                }
                            });

                            return false;
                        });

                    }
                });

            }
        });
    })

});
$('.formDeleteProduct').on('submit', function(e) {
   e.preventDefault()
    let _this = this
    var dataId = $(this).children("button").attr('data-id');

    $.ajax({
        url: '/destroy',
        type: 'POST',
        data: $(this).serialize(),
        success: function( msg ) {

               let number = $(_this).children("input[name='id']").val()
            $(`div[data-id=${number}]`).remove();


        },
        error: function( data ) {
            if ( data.status === 422 ) {
                // toastr.error('Cannot delete the category');
            }
        }
    });

    return false;
});

$('.formDeleteProductRooms').on('submit', function(e) {
    e.preventDefault()
    let _this = this
    var dataId = $(this).children("button").attr('data-id');

    $.ajax({
        url: '/destroyRoom',
        type: 'POST',
        data: $(this).serialize(),
        success: function( msg ) {

            // let number = $(_this).children("input[name='id']").val()
            $(_this).parents("a").remove();


        },
        error: function( data ) {
            if ( data.status === 422 ) {
                // toastr.error('Cannot delete the category');
            }
        }
    });

    return false;
});

// $("#attatch").on("submit",function (e){
//    e.preventDefault()
//     console.log($(this).serialize());
//     $.ajax({
//         url: '/imageupload',
//         enctype: "multipart/form-data",
//         type: 'POST',
//         data: $(this).serialize(),
//         success: function( msg ) {
//
//
//         }
//
//
//     })
//     return false;
// })



$('#subroomprivate').on('submit', function(e){
    e.preventDefault();
    var $this = $(this);

    $.ajax({
        url: $this.prop('action'),
        method: 'post',
        data: $this.serialize(),
    }).done(function(response){
        $.ajax({  //create an ajax request to display.php
            type: "GET",
            url: "/roomies",
            success: function (data) {
                $.ajax({  //create an ajax request to display.php
                    type: "GET",
                    url: "/users",
                    success: function (dataa) {
                        $("html, body, .card-body").animate({ scrollTop: 70000000000 }, 10);
                        let user = dataa.filter((item)=>{
                            return item.id == data[data.length - 1].user_id;
                        })


                        $(".rooms_container").append(`
                        <a href="room/${data[data.length - 1].id}" class="rooms_link">${data[data.length - 1].name}
                        <form method="POST" action="/destroyRoom" class="formDeleteProductRooms new"><input type="hidden" name="_token" value=${$(".formDeleteProductRooms>input[name='_token']").val()}> <input name="id" type="hidden" value=${data[data.length - 1].id}>
                        <button style="display: block" type="submit">Remove</button>
                        </form>
                        </a>
                        `)

                        $('.formDeleteProductRooms.new').on('submit', function(e) {

                            e.preventDefault()
                            let _this = this
                            var dataId = $(this).children("button").attr('data-id');

                            $.ajax({
                                url: '/destroyRoom',
                                type: 'POST',
                                data: $(this).serialize(),
                                success: function( msg ) {
                                    $(_this).parents("a").remove();
                                    let number = $(_this).children("input[name='id']").val()
                                    $(`div[data-id=${number}]`).remove();


                                },
                                error: function( data ) {
                                    if ( data.status === 422 ) {
                                        // toastr.error('Cannot delete the category');
                                    }
                                }
                            });

                            return false;
                        });

                    }
                });

            }
        });
    })

});
const domStuff = {
    init:function (){
      this.handleDrop()
    },
    handleDrop:function (){
      $('.card-dropdown-selected').click(function (){
          $(".card-dropdown-drop").slideToggle()
      })
    },
}.init()
