%radius = input('Enter Radius:');
%area = pi * (radius^2)
 
%str = input('input string:','s')
%len = length(str)


%name = input('Input your name:');

%disp('Hello world')

%x = 11;
%y = 48;
%plot(x,y,'b*');

%xlabel('Time');
%ylabel('Temperature');
%title('Time and Temp');

%axis([x-2 x+2 y-10 y+10])

%x = 1:6;
%y = [1 5 3 9 11 8];
%plot(y)


clf
x=1:5;
y1 = [2 11 6 9 3];
y2 = [4 5 8 6 2];

figure(1);
bar(x,y1);

figure(2)
plot(x,y1,'b--');
hold on
plot(x,y2,'ko');
grid on
legend('y1','y2');
