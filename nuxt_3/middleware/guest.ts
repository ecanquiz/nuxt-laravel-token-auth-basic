export default defineNuxtRouteMiddleware(() => {
  const cookie = useCookie('my_auth_token');
  if (cookie.value) {
    return navigateTo('/');
  }
});
  