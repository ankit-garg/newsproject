# newsproject


sample Request : http://52.66.184.42/?country=in&category=sports&keyword=tennis

sample response

{"code":200,"response":"3 Results found","data":{"Country":"in","Filter keyword":"tennis","Category":"sports","res":[{"News Title":"WATCH: Neymar Challenge reaches Wimbledon in legends doubles match","Description":"Neymar's \"theatrics\" during the World Cup Round of 16 match against Mexico were remembered during a ","Source News URL":"https:\/\/indianexpress.com\/article\/sports\/tennis\/watch-neymar-rolling-fall-video-wimbledon-2018-5259036\/"},{"News Title":"Angelique Kerber Beats Serena Williams To Lift Maiden Wimbledon Title","Description":"Angelique Kerber became the first German woman to win Wimbledon for 22 years.","Source News URL":"https:\/\/sports.ndtv.com\/tennis\/wimbledon-2018-angelique-kerber-beats-serena-williams-to-lift-maiden-title-1883367"},{"News Title":"Novak Djokovic Downs Rafael Nadal In Epic Battle To Reach Wimbledon Final","Description":"Novak Djokovic reached his fifth Wimbledon final with a 6-4, 3-6, 7-6 (11\/9), 3-6, 10-8 victory over","Source News URL":"https:\/\/sports.ndtv.com\/tennis\/wimbledon-2018-novak-djokovic-downs-rafael-nadal-in-epic-battle-to-reach-final-1883346"}]}}



sample request: http://52.66.184.42/?country=in&category=sports&keyword=ten

sample response

{"code":200,"response":"4 Results found","data":{"Country":"in","Filter keyword":"ten","Category":"sports","res":[{"News Title":"Novak Djokovic Downs Rafael Nadal In Epic Battle To Reach Wimbledon Final","Description":"Novak Djokovic reached his fifth Wimbledon final with a 6-4, 3-6, 7-6 (11\/9), 3-6, 10-8 victory over","Source News URL":"https:\/\/sports.ndtv.com\/tennis\/wimbledon-2018-novak-djokovic-downs-rafael-nadal-in-epic-battle-to-reach-final-1883346"},{"News Title":"Angelique Kerber Beats Serena Williams To Lift Maiden Wimbledon Title","Description":"Angelique Kerber became the first German woman to win Wimbledon for 22 years.","Source News URL":"https:\/\/sports.ndtv.com\/tennis\/wimbledon-2018-angelique-kerber-beats-serena-williams-to-lift-maiden-title-1883367"},{"News Title":"WATCH: Neymar Challenge reaches Wimbledon in legends doubles match","Description":"Neymar's \"theatrics\" during the World Cup Round of 16 match against Mexico were remembered during a ","Source News URL":"https:\/\/indianexpress.com\/article\/sports\/tennis\/watch-neymar-rolling-fall-video-wimbledon-2018-5259036\/"},{"News Title":"Thailand Open 2018: India's PV Sindhu edges past Gregoria Tunjung to set up title clash against Nozomi Okuhara","Description":"The second-seeded Sindhu continued her unbeaten run in the Thai capital with a 23-21, 16-21, 21-9 wi","Source News URL":"https:\/\/www.firstpost.com\/sports\/thailand-open-2018-indias-pv-sindhu-edges-past-gregoria-tunjung-to-set-up-title-clash-against-nozomi-okuhara-4741521.html"}]}}



sample request : http://52.66.184.42/?country=in&category=sports&keyword=crickit

sample response

{"code":200,"response":"1 suggestions found","data":{"Country":"in","Filter keyword":"crickit","Category":"sports","Did You Mean This":["cricket"]}}



sample request: http://52.66.184.42/?country=in&category=sports&keyword=sajkbd

sample response

{"code":404,"response":"OOPS!! We don't found anything","data":{"Country":"in","Filter keyword":"sajkbd","Category":"sports"}}



sample request: http://52.66.184.42/?country=in&category=sports

sample response

{"code":403,"response":"keyword missing"}

