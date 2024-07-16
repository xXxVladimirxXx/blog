import axios from 'axios'
const CSRF_TOKEN_MISMATCH = 419
const UNAUTHENTICATED_ERROR_CODE = 401

const axiosIns = axios.create({
// You can add your headers here
// ================================
  baseURL: import.meta.env.VITE_API_URL,
  headers: {
    'X-Requested-With': 'XMLHttpRequest',
  },
  withCredentials: true
// timeout: 1000,
// headers: {'X-Custom-Header': 'foobar'}
})

/**
 * Check if authorized current user
 */
axiosIns.interceptors.response.use(function (response) {
  // Any status code that lie within the range of 2xx cause this function to trigger
  // Do something with response data
  return response
}, function (error) {
  console.log('error');
  console.log(error);
  // Any status codes that falls outside the range of 2xx cause this function to trigger
  // Do something with response error
  if (undefined !== error.response && (CSRF_TOKEN_MISMATCH === error.response.status || UNAUTHENTICATED_ERROR_CODE === error.response.status)) {
    localStorage.removeItem('userData')
    // window.location.replace('/login')
  }
  // if (undefined !== error.response) {
  //   if ('User token authentication failure.' === error.response.data.message || 'Unauthenticated.' === error.response.data.message) {
  //     window.location.replace('/auth')
  //   }
  //
  //   if ('This action is unauthorized.' === error.response.data.message) {
  //   }
  // }
  //
  return Promise.reject(error)
})

export default axiosIns
