clc;clear
%% ���ɵ����źŵĶ�������
FD_Enable = 0;
simglToneDataReFile = 'singleToneRe.coe';
simglToneDataImFile = 'singleToneIm.coe';
%% Parameters
fm = 2e6 ;         % �ź�Ƶ��
fs = 122.88e6;     % ��������
w  = 2*pi*fm;
dt = 1/fs;         % �������
t  = 0:dt:dt*3275; % 3276����
a  = 1;            % �źŷ��� 
%% Data generator
data = a * exp(1i*w*t);

%% Time Domain Data,��������������Q��12,11�����ꣻ
tdDataIm = round((2^11-1)*imag(data));
tdDataRe = round((2^11-1)*real(data));

writeData2File(simglToneDataImFile,tdDataIm);
writeData2File(simglToneDataReFile,tdDataRe);

figure(1);
plot(data);
figure(2);
hold on;
plot(tdDataIm);
hold on;
plot(tdDataRe);
%% 


%% �ȶ����ݽ��й�һ�����ȳ����źŷ�������ֵ
if FD_Enable
dataFFT = fft(data,4096)./2906;

%% ����������ѡ�����13λ��Ч�������з���λ�����Գ���(2^12-1)��
vectorReal = (2^12-1)*real(dataFFT);
vectorImag = (2^12-1)*imag(dataFFT);
%% ͨ��round�������н�ȡ
vectorRe = round(vectorReal);
vectorIm = round(vectorImag);

figure(1);
plot(vectorRe)
hold on;
plot(vectorIm);
end %% FD_Enable