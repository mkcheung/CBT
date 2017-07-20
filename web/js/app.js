/**
 * Created by marscheung on 7/17/17.
 */
(function(){

    window.app = window.app || {};

    var UsersView = Backbone.View.extend({
        el: "#tempX",

        initialize: function (options) {
            this.template = _.template($('#testTemplate').html())
            this.options = options.collection;
            console.log(this.options);
        },

        events:{
            'click #userinputformsubmit': 'createNewUser'
        },

        createNewUser: function(e){
            e.preventDefault();
            var that = this;

            var username = $("#username").val();
            var lastname = $("#last_name").val();
            var firstname = $("#first_name").val();
            var email = $("#email").val();
            var password = $("#password").val();

            var data = {
                "username": username,
                "firstname": firstname,
                "lastname": lastname,
                "email": email,
                "password":password
            };

            var promise = $.ajax(this.ajaxUpdate(data));
            promise.done(function(){
                that.tbl
                    .rows()
                    .invalidate()
                    .draw();
            })
        },

        ajaxUpdate: function(data){
          var that = this;
          return{
              type: "POST",
              url:'/users/create',
              data:data,
              dataType:"JSON",
              beforeSend: function(xhr){
              },
              success: function(response){
              }
          };
        },


        render: function render(){
            var self = this;

            this.$el.html(this.template);

            this.tbl = $("#testing1234").DataTable({
                data: this.collection.toJSON(),
                columns:[{
                    "data":"username",
                    "width":"235px",
                    "orderable":true
                }, {
                    "data":"first_name",
                    "width":"235px",
                    "orderable":true
                }, {
                    "data":"last_name",
                    "width":"235px",
                    "orderable":true
                }, {
                    "data":"email",
                    "width":"235px",
                    "orderable":true
            }]
            });

            return this;
        }
    });
    var allUsers = new Backbone.Collection;
    allUsers.add(JSON.parse(window.usersJson));
    var usersView = new UsersView({
        collection:allUsers
    });
    usersView.render();

})();