/**
 * Created by marscheung on 7/17/17.
 */
(function(){

    window.app = window.app || {};

    var UsersView = Backbone.View.extend({
        el: "#tempX",

        initialize: function (options) {
            this.template = _.template($('#testTemplate').html())
            this.collection = options.collection;
            this.collection.on('add', this.render, this);
            console.log(this.collection);
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
                "first_name": firstname,
                "last_name": lastname,
                "email": email,
                "password":password
            };

            var promise = $.ajax(this.ajaxUpdate(data));
            promise.done(function(response){
                that.collection.add(data);
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
                  console.log(response);
              }
          };
        },


        render: function render(){
            var self = this;

            this.$el.html(this.template);
console.log(this.collection.toJSON());
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