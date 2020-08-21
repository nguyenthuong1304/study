import createRepository from "../api/Repository";

export default (ctx, inject) => {
    const repositoryWithAxios = createRepository(ctx.$axios);
}
