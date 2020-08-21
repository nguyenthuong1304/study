import axios from "axios";

export default {
    data() {
        return {
            collection: [],
            page: 1,
            total: 0,
            query: {},
            access_token: this.$auth.$storage._state["_token.local"],
        };
    },
    computed: {},
    methods: {
        isEmpty(obj) {
            return Object.keys(obj).length === 0 && obj.constructor === Object;
        },
        async search(event, setLoading = true) {
            this.query = event;
            await this.setLoading(setLoading);
            const { data } = await axios.post(
                process.env.URL_API + `/search?page=${this.page}`,
                this.query,
                {
                    headers: {
                        "Access-Control-Allow-Origin": "*",
                        "Content-Type": "application/json"
                    }
                }
            );
            this.collection = data.data.data;
            this.total = data.data.total;
            this.setLoading(false);
            this.$router.push({
                path: this.$route.path,
                query: {
                    cates: this.query.category.join(','),
                    keyword: this.query.keyword,
                    address: this.query.address,
                    page: this.query.page ? this.query.page : this.page
                }
            });
        },
        async addFavorite(userId) {
            try {
                const { data } = axios.post(`${process.env.URL_API}/add-favorite/${userId}`, {}, {
                    headers: {'Authorization': this.access_token}
                });
            } catch(err) {
                this.handleException(err);
            }
        },
        handleException(err) {
            console.log(err)
        }
    }
};
