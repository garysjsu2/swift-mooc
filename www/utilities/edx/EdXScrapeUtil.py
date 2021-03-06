# reference:https://pythonhosted.org/feedparser/reference.html

import feedparser
import MySQLdb
from datetime import datetime

db = MySQLdb.connect(host="localhost", user="root", passwd="", db="moocs160")
cur = db.cursor()

rss_links = ["https://www.edx.org/api/v2/report/course-feed/rss",
             "https://www.edx.org/api/v2/report/course-feed/rss?page=1",
             "https://www.edx.org/api/v2/report/course-feed/rss?page=2",
             "https://www.edx.org/api/v2/report/course-feed/rss?page=3",
             "https://www.edx.org/api/v2/report/course-feed/rss?page=4",
             "https://www.edx.org/api/v2/report/course-feed/rss?page=5",
             "https://www.edx.org/api/v2/report/course-feed/rss?page=6"]

def add_profs_detail(c_id, profname, profimage):
    # note: there are some duplicate courses on edx. used the LIMIT keyword to handle those cases.
    # get some duplicate data and this is a bit of a hacky solution. should probably do a similar
    # select query to get the corresponding course id from course_data, then do a row count to see if
    # there are duplicates, if there are duplicates then skip
    cur.execute("INSERT INTO coursedetails \
                    (id, profname, profimage, course_id) \
                    VALUES \
                    (%d, '%s', '%s', (SELECT id FROM course_data WHERE course_link='%s' LIMIT 1))"
                    % (c_id, profname, profimage, course_link))

    db.commit()
    

def add_course(title, short_desc, long_desc, course_link, video_link,
                start_date, course_length, course_image, category, site,
                course_fee, language, certificate, university, time_scraped):
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

for rss_link in rss_links:
    d = feedparser.parse(rss_link)

    i = 0
    numentries = len(d.entries)
    print numentries
    while (i < numentries):
        entry = d.entries[i]

        title = ''
        if 'title' in entry:
            title = entry['title'].encode('ascii', 'ignore')
            title = title.replace("'", "''")
            print title

        short_desc = ''
        if 'course_subtitle' in entry:
            short_desc = entry['course_subtitle'].encode('ascii', 'ignore')
            short_desc = short_desc.replace("'", "''")
            print short_desc

        long_desc = ''
        if 'summary' in entry:
            long_desc = entry['summary'].encode('ascii', 'ignore')
            long_desc = long_desc.replace("'", "''")
            print long_desc

        course_link = ''
        if 'link' in entry:
            course_link = entry['link'].encode('ascii', 'ignore')
            print course_link

        video_link = ''
        if 'course_video-youtube' in entry:
            video_link = entry['course_video-youtube'].encode('ascii', 'ignore')
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
        if 'course_image-thumbnail' in entry:
            course_image = entry['course_image-thumbnail'].encode('ascii', 'ignore')
            print course_image

        # only getting one category for now
        category = ''
        if 'course_subject' in entry:
            category = entry['course_subject'].encode('ascii', 'ignore')
            category = category.replace("'", "''")
            print category

        site = 'EdX'

        # no info on course fee
        course_fee = 0

        language = 'English'

        # no info on certificate
        certificate = 'yes'

        university = ''
        if 'school' in entry:
            university = entry['school'].encode('ascii', 'ignore')
            university = university.replace("'", "''")
            print university

        time_scraped = datetime.now()

        cur.execute('SELECT COUNT(*) FROM coursedetails')
        (c_id,) = cur.fetchone()
    
        profname = ''
        if 'staff_name' in entry:
            profname = entry['staff_name'].encode('ascii', 'ignore')
            profname = profname.replace("'", "''")
            profname = profname[0:29] # 30 chars max
            print profname
        
        profimage = ''
        if 'staff_image' in entry:
            profimage = entry['staff_image'].encode('ascii', 'ignore')
            profimage = profimage.replace("'", "''")
            print profname

        add_course(title, short_desc, long_desc, course_link, video_link, start_date,
                     course_length, course_image, category, site, course_fee, language,
                     certificate, university, time_scraped)

        add_profs_detail(c_id, profname, profimage) 

        i = i + 1


db.close()
