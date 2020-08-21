export default $axios => resource => ({
    async index() {
        return await $axios.$get(`/${resource}`)
    },

    async create(payload) {
        return await $axios.$post(`/${resource}`, payload)
    },

    async show(id) {
        return await $axios.$get(`/${resource}/${id}`)
    },

    async update(payload, id) {
        return await $axios.$put(`/${resource}/${id}`, payload)
    },

    async delete(id) {
        return $axios.$delete(`/${resource}/${id}`);
    }
})
