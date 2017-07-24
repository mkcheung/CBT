/**
 * Created by marscheung on 7/17/17.
 */
(function(){

    window.app = window.app || {};

    var UsersView = Backbone.View.extend({
        el: "#tempX",

        initialize: function (options) {
            this.template = _.template($('#testTemplate').html())
            this.collection.on('add', this.render, this);
            this.listenTo(this.collection, 'remove', this.render);
        },

        events:{
            'click #userinputformsubmit': 'createNewUser',
            'click .userDeleteSubmit': 'deleteUser'
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

            var promise = $.ajax(this.ajaxUpdate(data,'create_user','POST'));
            promise.done(function(response){
                var newUserData = JSON.parse(response.data);

                var newUser = new UserModel({
                    username: newUserData.username,
                    first_name: newUserData.username,
                    last_name: newUserData.last_name,
                    email: newUserData.email,
                    user_id: newUserData.user_id
                });
                that.collection.add(newUser);
            })
        },

        deleteUser: function(event){
            var that = this;
            event.preventDefault();
            var userId = $(event.currentTarget).data('id');

            var data = {
                "user_id": userId
            };
            var promise = $.ajax(this.ajaxUpdate(data, 'delete_user', 'DELETE'));
            promise.done(function(response){

                // that.collection.remove([{ 'user_id': data.user_id }]);
                var toDelete = that.collection.get(data.user_id);
                console.log(toDelete);
                // that.collection.where({'user_id': data.user_id});
                that.collection.remove(toDelete);
            });
        },

        ajaxUpdate: function(data, path, verb){
          var that = this;
          return{
              type: verb,
              url: Routing.generate(path),
              data:data,
              beforeSend: function(xhr){
              },
              success: function(response){
              }
          };
        },

        renderDeleteButton: function(data){
            var delButton = _.template($('#userDeleteButtonTemplate').html());
            return delButton({
                id:data
            });
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
                }, {

                    "data":"user_id",
                    "render": self.renderDeleteButton
                }]
            });
            return this;
        }
    });

    var UserModel = Backbone.Model.extend({
        idAttribute:"user_id"
    });
    var UsersCollection = Backbone.Collection.extend({
        model:UserModel,
        parse: function(response){
            return JSON.parse(response);
        },
        url: function(){
            return Routing.generate('get_all_users');
        }
    });

    allUsers = new UsersCollection();

    $.when(allUsers.fetch()).then(function(){
        var usersView = new UsersView({
            collection:allUsers
        });
        window.usersView = usersView;
        window.usersView.render();
    });

})();