import axios from 'axios';

export const HTTP_API = axios.create({
  baseURL: window.siteUrl+'/apipublic/',
});