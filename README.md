# newsproject

The server was deployed on ec2 t2.micro instance with elasticsearch,redis and web server running.

Benchmarking

Benchmarking 52.66.184.42 (be patient)

Completed 1000 requests

Completed 2000 requests

Completed 3000 requests

Completed 4000 requests

Completed 5000 requests

Completed 6000 requests

Completed 7000 requests

Completed 8000 requests

Completed 9000 requests

Completed 10000 requests

Finished 10000 requests


Server Software:        swoole-http-server

Server Hostname:        52.66.184.42

Server Port:            80

Document Path:          /?country=in&category=sports&keyword=tennis 

Document Length:        1143 bytes


Concurrency Level:      1000

Time taken for tests:   21.695 seconds

Complete requests:      10000

Failed requests:        0

Total transferred:      13080000 bytes

HTML transferred:       11430000 bytes

Requests per second:    460.93 [#/sec] (mean)

Time per request:       2169.507 [ms] (mean)

Time per request:       2.170 [ms] (mean, across all concurrent requests)

Transfer rate:          588.77 [Kbytes/sec] received



Connection Times (ms)

                min  mean[+/-sd] median   max

Connect:        0    3   8.9      0      48

Processing:    49 2067 372.1   2159    2300

Waiting:       49 2067 372.1   2159    2300

Total:         60 2070 367.7   2159    2309


Percentage of the requests served within a certain time (ms)

50%   2159

66%   2181

75%   2207

80%   2237

90%   2275

95%   2283

98%   2291

99%   2294

100%   2309 (longest request)

