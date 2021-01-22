# Hikvision to MQTT

## Start-up
1. Download the project:

        git clone https://github.com/zoilomora/hikvision-to-mqtt.git
        # or
        wget https://github.com/zoilomora/hikvision-to-mqtt/archive/master.zip

2. Check the `docker-compose.yml` to see if there are any conflicts with the ports.

3. Start the whole environment:

        make start

4. Once started you will be in a shell inside the php container, check the correct functioning of the system:

        /var/app $ console about
         -------------------- ---------------------------------------- 
          Symfony                                                      
         -------------------- ---------------------------------------- 
          Version              5.2.1                                   
          Long-Term Support    No                                      
          End of maintenance   07/2021                                 
          End of life          07/2021                                 
         -------------------- ---------------------------------------- 
          Kernel                                                       
         -------------------- ---------------------------------------- 
          Type                 ZoiloMora\HikvisionCommunicator\Kernel  
          Environment          dev                                     
          Debug                true                                    
          Charset              UTF-8                                   
          Cache directory      ./var/cache/dev (329 KiB)               
          Build directory      ./var/cache/dev (329 KiB)               
          Log directory        ./var/log (0 B)                         
         -------------------- ---------------------------------------- 
          PHP                                                          
         -------------------- ---------------------------------------- 
          Version              7.4.1                                   
          Architecture         64 bits                                 
          Intl locale          n/a                                     
          Timezone             UTC (2021-01-22T19:47:27+00:00)         
          OPcache              false                                   
          APCu                 false                                   
          Xdebug               false                                   
         -------------------- ---------------------------------------- 

5. Now leave the container:

        /var/app $ exit

6. You can leave the system connected:

        docker-compose up -d

## DVR settings
1. Use the [iVMS-4200 Client](https://www.hikvision.com/en/support/download/software/ivms4200-series/) to access the remote configuration of the device.

2. Go to `Event > Email` and configure the `fake-smpt-server` as **SMTP Server** (default port 1025).
You can enter any source and destination address, for example:

        Sender Address: <hikvision> hikvision@dvr.local
        Receiver Address: <server> hikvision@server.local

3. Activate in the events that the Linkage Action: **Email Linkage**.

## Check operation
Run a **MQTT Client** to monitor the topic (replace `<server_id>` with the **IP Address** of your **MQTT Server**):

    docker run --init -it --rm efrecon/mqtt-client sub -h <server_ip> -t "alerts" -v
    
    # Result
    alerts {"type":"Motion Detected","device":{"name":"Embedded Net DVR","serial_number":"******"},"camera":{"name":"Camera 1","number":"A1"},"occurred_on":{"date":"2020-01-06 14:51:02.000000","timezone_type":3,"timezone":"Europe\/Madrid"}}

You can also see the logs of the docker containers to see what is happening:

    docker-compose logs -f
    
    # Result
    mqtt_1 | 1578318663: New connection from 10.10.12.4 on port 1883.
    mqtt_1 | 1578318663: New client connected from 10.10.12.4 as hikvision (p2, c1, k60).
    php_1  | Published message: {"type":"Motion Detected","device":{"name":"Embedded Net DVR","serial_number":"******"},"camera":{"name":"Camera 1","number":"A1"},"occurred_on":{"date":"2020-01-06 14:51:02.000000","timezone_type":3,"timezone":"Europe\/Madrid"}}
    mqtt_1 | 1578318663: Client hikvision disconnected.
