const request = require('request');
const options = {
method: 'post',
url: 'https://mercury-uat.phonepe.com/enterprise-sandbox/v3/payLink/init',
headers: {
accept: 'text/plain',

Content-Type : 'application/json' ,
X-VERIFY : '5bff32221edd5d1cbf647448f0ca5c3ec8a428065b4fdc6d97f9a16bd88b98bf###1'
}
body: {},
};

request(options, function (error, response, body) {
if (error) throw new Error(error);
console.log(body);
});