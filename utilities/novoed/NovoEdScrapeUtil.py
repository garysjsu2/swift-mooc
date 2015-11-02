from datetime import datetime
import requests
import MySQLdb

db = MySQLdb.connect(host="localhost", user="root", passwd="your_password",
		db="moocs160")

cur = db.cursor()

def add_course(title, short_desc, long_desc, course_link, video_link,
		start_date, course_length, course_image, category, site, course_fee,
		language, certificate, university, time_scraped):

	cur.execute("INSERT INTO course_data \
		(title, short_desc, long_desc, course_link, \
		video_link, start_date, course_length, course_image, category, \
		site, course_fee, language, certificate, university, \
		time_scraped) \
		VALUES \
		(%(title)s, %(short_desc)s, %(long_desc)s, %(course_link)s, \
		%(video_link)s, %(start_date)s, %(course_length)s, %(course_image)s, %(category)s, \
		%(site)s, %(course_fee)s, %(language)s, %(certificate)s, %(university)s, \
		NOW())", dict(title=title, short_desc=short_desc, long_desc=long_desc,
			course_link=course_link,
				 video_link=video_link, start_date=start_date, course_length=0,
				 course_image=course_image, category=category,
				 site=site, course_fee=0, language=language, certificate='yes', 
				 university=university))
	db.commit()	

res = requests.get('https://novoed.com/courses/all.json')

# This already contains all the courses on NovoEd..
res_json = res.json()

for course in res_json['courses']:
	title = course['name'].encode('ascii', 'ignore')
	short_desc = course['executive_summary'].encode('ascii', 'ignore')
	long_desc = course['executive_summary'].encode('ascii', 'ignore')
	course_link = 'https://novoed.com' + course['url'] 
	video_link = ''
	start_date = datetime.now()
	course_length = 0
	course_image = course['large_cover_photo_url']
	category = course['get_catalog_name'].encode('ascii', 'ignore')
	site = '' 
	course_fee = 0
	language = 'EN' 
	certificate = 'yes'
	university = course['institution_name'].encode('ascii', 'ignore')
	time_scraped = datetime.now()

	# add the course
	add_course(title, short_desc, long_desc, course_link, 
		video_link, start_date, course_length, course_image, category,
		site, course_fee, language, certificate, university, time_scraped)

