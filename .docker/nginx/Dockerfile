FROM nginx:1.16
ARG APP_HOST


COPY ./sites/site.conf.template /etc/nginx/sites-available/site.conf.template
RUN envsubst '${APP_HOST}' < /etc/nginx/sites-available/site.conf.template > /etc/nginx/sites-available/site.conf

RUN rm -f /etc/nginx/sites-available/site.conf.template && rm -f /etc/nginx/sites-available/ssl-site.conf.template

RUN rm -f /etc/nginx/sites-available/ssl-site.conf; 
