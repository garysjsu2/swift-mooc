# reference:https://pythonhosted.org/feedparser/reference.html

import feedparser
import MySQLdb
from datetime import datetime

db = MySQLdb.connect(host="localhost", user="root", passwd="yourpassword", db="moocs160")
cur = db.cursor()

rss_links = ["https://www.edx.org/api/v2/report/course-feed/rss",
             "https://www.edx.org/api/v2/report/course-feed/rss?page=1",
             "https://www.edx.org/api/v2/report/course-feed/rss?page=2",
             "https://www.edx.org/api/v2/report/course-feed/rss?page=3",
             "https://www.edx.org/api/v2/report/course-feed/rss?page=4",
             "https://www.edx.org/api/v2/report/course-feed/rss?page=5",
             "https://www.edx.org/api/v2/report/course-feed/rss?page=6"]

for rss_link in rss_links:
    d = feedparser.parse(rss_link)

    i = 0
    numentries = len(d.entries)
    print numentries
    while (i < numentries):
        entry = d.entries[i]

        """ insert into course_data """

        title = ''
        if 'title' in entry:
            title = entry['title'].encode('ascii', 'ignore')
            # take out single quote else will break sql statement
            title = title.replace("'", " ")
            print title

        short_desc = ''
        if 'course_subtitle' in entry:
            short_desc = entry['course_subtitle'].encode('ascii', 'ignore')
            short_desc = short_desc.replace("'", " ")
            print short_desc

        long_desc = ''
        if 'summary' in entry:
            long_desc = entry['summary'].encode('ascii', 'ignore')
            long_desc = long_desc.replace("'", " ")
            print long_desc

        course_link = ''
        if 'link' in entry:
            course_link = entry['link'].encode('ascii', 'ignore')
            print course_link

        video_link = ''
        if 'video_youtube' in entry:
            video_link = entry['video_youtube'].encode('ascii', 'ignore')
            print video_link

        start_date = ''
        if 'course_start' in entry:
            start_date = entry['course_start'].encode('ascii', 'ignore')
            print start_date

        course_length = 0
        if 'course_length' in entry:
            course_length = entry['course_length'].encode('ascii', 'ignore')
            if len(course_length) > 0: #some cases where the course length is empty even with the course length tag present
                course_length = int(course_length[0:1])
                print course_length
            else:
                course_length = 0

        course_image = ''
        if 'image_thumbnail' in entry:
            course_image = entry['image_thumbnail'].encode('ascii', 'ignore')
            print course_image

        # only getting one category for now
        category = ''
        if 'course_subject' in entry:
            category = entry['course_subject'].encode('ascii', 'ignore')
            category = category.replace("'", " ")
            print category

        # what is site supposed to correspond to?
        site = ''

        # no info on course fee?
        course_fee = 0

        language = ''
        if 'language' in entry:
            language = entry['language'].encode('ascii', 'ignore')
            print language

        # no info on certificates?

        # yes for now
        certificate = 'yes'

        university = ''
        if 'school' in entry:
            university = entry['school'].encode('ascii', 'ignore')
            university = university.replace("'", " ")
            print university

        time_scraped = datetime.now()

        cur.execute("INSERT INTO course_data \
                       (id, title, short_desc, long_desc, course_link, \
                       video_link, start_date, course_length, course_image, category, \
                       site, course_fee, language, certificate, university, \
                       time_scraped) \
                       VALUES \
                       (DEFAULT, '%s', '%s', '%s', '%s', \
                       '%s', '%s', %d, '%s', '%s', \
                       '%s', %d, '%s', 'yes', '%s', \
                        NOW())" % (title, short_desc, long_desc, course_link,
                                video_link, start_date, course_length, course_image, category,
                                site, course_fee, language, university))
        db.commit()

        """ insert into coursedetails """
    
        profname = ''
        if 'staff_name' in entry:
            profname = entry['staff_name'].encode('ascii', 'ignore')
            profname = profname.replace("'", " ")
            print profname
        
        profimage = ''
        if 'staff_image' in entry:
            profimage = entry['staff_image'].encode('ascii', 'ignore')
            profimage = profimage.replace("'", " ")
            print profname

        course_id = ''
        if 'course_id' in entry:
            course_id = entry['course_id'].encode('ascii', 'ignore')
            course_id = profimage.replace("'", " ")
            print course_id

        cur.execute("INSERT INTO coursedetails \
                       (id, title, profname, profimage, course_id) \
                       VALUES \
                       ((SELECT id FROM course_data WHERE long_desc = '%s'), \
                        '%s', '%s', '%s', '%s'" % (long_desc, title, profname, profimage, course_id))

        db.commit()

        i = i + 1


db.close()
