let user = window.App.user ? window.App.user : 'guest';
// let user = window.App.user;



module.exports = {
    updateReply (reply) {
        return reply.user_id === user.id;
    },

    updateThread (thread) {
        return thread.user_id === user.id;
    },

    owns(model, prop = 'user_id') {
        return model[prop] === user.id;
    },

    isAdmin () {
        return ['Mihail', 'santa'].includes(user.name);
    }
}

